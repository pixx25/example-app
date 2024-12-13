<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all posts with their associated user and paginate the results
        $posts = Post::with('user')->paginate(6); // Show 6 posts per page
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve all users (if needed for assigning authorship)
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing post data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming post data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        // Create a new post associated with the authenticated user
        $post = auth()->user()->posts()->create($validatedData);

        // Redirect to the newly created post's detail page
        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified post and its comments.
     *
     * @param \App\Models\Post $post The post to be displayed.
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        // Load the comments and their associated users for the post
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param \App\Models\Post $post The post to be edited.
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        // Retrieve all users (if needed for reassigning authorship)
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing updated data.
     * @param \App\Models\Post $post The post to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        // Validate the updated post data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        // Update the post with the validated data
        $post->update($validatedData);

        // Redirect to the updated post's detail page
        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param \App\Models\Post $post The post to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        // Delete the post from storage
        $post->delete();

        // Redirect back to the posts index page
        return redirect()->route('posts.index');
    }
}
