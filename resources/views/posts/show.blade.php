<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
<p>By {{ $post->user->name }}</p>

<!-- Back to Posts Button -->
<a href="{{ route('posts.index') }}" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
    Back to Posts
</a>

<h2>Comments</h2>

<!-- Display existing comments -->
@if ($post->comments->isEmpty())
    <p>No comments yet. Be the first to comment!</p>
@else
    @foreach ($post->comments as $comment)
        <div style="margin-bottom: 10px; padding: 10px; border: 2px solid #ddd;">
            <p>{{ $comment->content }}</p>
            <p><small>- by {{ $comment->user ? $comment->user->name : 'Guest' }}</small></p>
            <!-- Delete button -->
            
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Delete</button>
                </form>
            
        </div>
    @endforeach
@endif

<!-- Display feedback messages -->
@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<!-- Comment form -->
<form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top: 20px;">
    @csrf
    <textarea name="content" rows="4" style="width: 100%;" placeholder="Write your comment..." required></textarea>
    <button type="submit">Comment</button>
</form>
