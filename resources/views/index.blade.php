@foreach ($posts as $post)
    <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
    <p>{{ $post->content }}</p>
    <p>By {{ $post->user->name }}</p>
@endforeach
