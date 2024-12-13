<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $fillable = ['post_id', 'author', 'content'];

    /**
     * Display a listing of the comments.
     */
    public function index(Post $post)
    {
        // Retrieve all comments for the given post
        $comments = $post->comments()->with('user')->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create(Post $post)
    {
        $users = User::all();
        return view('comments.create', compact('post', 'users'));
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return redirect()->route('posts.show', $post)->withErrors('You must be logged in to post a comment.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->post_id = $post->id;
        $comment->user_id = auth()->check() ? auth()->id() : null;
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }


    /**
     * Display the specified comment.
     */
    public function show(Post $post, Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Post $post, Comment $comment)
    {
        $users = User::all();
        return view('comments.edit', compact('post', 'comment', 'users'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $comment->update($validatedData);

        return redirect()->route('comments.index', $post);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index', $post);
    }
}