<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Define fillable attributes for mass assignment protection
    protected $fillable = ['post_id', 'author', 'content'];

    /**
     * Display a listing of the comments for a given post.
     *
     * @param Post $post The post whose comments are to be displayed.
     * @return \Illuminate\View\View
     */
    public function index(Post $post)
    {
        // Retrieve all comments for the given post, including their associated user
        $comments = $post->comments()->with('user')->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment for a specific post.
     *
     * @param Post $post The post to which the comment will be added.
     * @return \Illuminate\View\View
     */
    public function create(Post $post)
    {
        // Retrieve all users (for example, to assign an author if needed)
        $users = User::all();
        return view('comments.create', compact('post', 'users'));
    }

    /**
     * Store a newly created comment in storage for the specified post.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing comment data.
     * @param Post $post The post to which the comment belongs.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Post $post)
    {
        // Validate the incoming comment data
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Create a new comment and associate it with the post and authenticated user (if any)
        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->post_id = $post->id;
        $comment->user_id = auth()->check() ? auth()->id() : null;
        $comment->save();

        // Redirect back to the post page with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

    /**
     * Display the details of a specific comment.
     *
     * @param Post $post The post the comment belongs to.
     * @param Comment $comment The specific comment to display.
     * @return \Illuminate\View\View
     */
    public function show(Post $post, Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param Post $post The post the comment belongs to.
     * @param Comment $comment The comment to be edited.
     * @return \Illuminate\View\View
     */
    public function edit(Post $post, Comment $comment)
    {
        // Retrieve all users (if needed for editing author information)
        $users = User::all();
        return view('comments.edit', compact('post', 'comment', 'users'));
    }

    /**
     * Update the specified comment in storage.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing updated data.
     * @param Post $post The post the comment belongs to.
     * @param Comment $comment The comment to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        // Validate the updated comment data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        // Update the comment with the validated data
        $comment->update($validatedData);

        // Redirect to the comments index page
        return redirect()->route('comments.index', $post);
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param Post $post The post the comment belongs to.
     * @param Comment $comment The comment to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post, Comment $comment)
    {
        // Ensure the logged-in user is authorized to delete the comment
        if (auth()->id() !== $comment->user_id) {
            return redirect()->back()->withErrors(['Unauthorised action']);
        }

        // Delete the comment
        $comment->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
