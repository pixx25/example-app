<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
<p>By {{ $post->user->name }}</p>

<h2>Comments</h2>

<!-- Display existing comments -->
@if ($post->comments->isEmpty())
    <p>No comments yet. Be the first to comment!</p>
@else
    @foreach ($post->comments as $comment)
        <div style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd;">
            <p>{{ $comment->content }}</p>
            <p><small>- by {{ $comment->user ? $comment->user->name : 'Guest' }}</small></p>
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

