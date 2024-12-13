<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
<p>By {{ $post->user->name }}</p>
<h2>Comments</h2>
@foreach ($post->comments as $comment)
    <p>{{ $comment->content }} - by {{ $comment->user->name }}</p>
@endforeach
@auth
    <form action="{{ route('comments.store', $post) }}" method="POST">
        @csrf
        <textarea name="content" required></textarea>
        <button type="submit">Comment</button>
    </form>
@endauth
