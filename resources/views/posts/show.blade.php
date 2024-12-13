<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>

    <!-- Inline CSS for styling the page -->
    <style>
        /* General styling for the body with beige background and dark gray text */
        body {
            background-color: #F5F5DC; /* Beige background */
            color: #333; /* Dark gray text for readability */
            font-family: 'Arial', sans-serif; /* Set font family */
            margin: 0;
            padding: 20px;
        }

        /* Styling for the main heading and subheading with a muted green color */
        h1, h2 {
            color: #6B705C; /* Muted green for headings */
            font-family: 'Georgia', serif; /* Serif font for headings */
        }

        /* Styling for links and buttons (uniform for both) */
        a, button {
            font-family: 'Arial', sans-serif; /* Ensure consistency in font */
            border: none; /* Remove default borders */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Show a pointer cursor on hover */
        }

        /* Styling for links (as buttons) */
        a {
            background-color: #6B705C; /* Muted green background */
            color: white; /* White text */
            text-decoration: none; /* Remove underline */
            padding: 10px 20px; /* Add padding for button look */
            display: inline-block; /* Keep the link inline */
            margin-top: 20px; /* Add some space above the link */
        }

        /* Hover effect for links */
        a:hover {
            background-color: #BC6C25; /* Warm brown hover effect */
        }

        /* Styling for individual comments */
        .comment {
            background-color: white; /* White background for contrast */
            border: 1px solid #DDA15E; /* Warm tone border around comment */
            border-radius: 8px; /* Rounded corners for comment box */
            padding: 15px; /* Add padding inside the comment box */
            margin-bottom: 15px; /* Space between comments */
        }

        /* Styling for the delete button inside comments */
        .delete-button {
            background-color: #BC6C25; /* Warm accent color for delete button */
            color: white; /* White text */
            padding: 8px 15px; /* Padding to make the button look like a clickable item */
            border-radius: 5px; /* Rounded corners for the button */
        }

        /* Hover effect for the delete button */
        .delete-button:hover {
            background-color: #8C4A15; /* Darker brown when hovering */
        }

        /* Styling for the comment textarea input */
        textarea {
            width: 100%; /* Make the textarea take up the full width */
            background-color: white; /* White background */
            border: 1px solid #DDA15E; /* Warm border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px; /* Add padding inside the textarea */
            margin-top: 10px; /* Space above the textarea */
        }

        /* Styling for the submit button in the comment form */
        .comment-form button {
            background-color: #6B705C; /* Muted green background */
            color: white; /* White text */
            padding: 10px 20px; /* Padding for a button-like appearance */
            border-radius: 5px; /* Rounded corners */
            margin-top: 10px; /* Add space above the button */
        }

        /* Hover effect for the comment form button */
        .comment-form button:hover {
            background-color: #BC6C25; /* Warm brown hover effect */
        }
    </style>
</head>
<body>

    <!-- Post Title -->
    <h1>{{ $post->title }}</h1>
    <!-- Post Content -->
    <p>{{ $post->content }}</p>
    <!-- Post Author -->
    <p>By {{ $post->user->name }}</p>

    <!-- Button to go back to the posts index page -->
    <a href="{{ route('posts.index') }}">Back to Posts</a>

    <!-- Section Heading for Comments -->
    <h2>Comments</h2>

    <!-- Check if the post has comments -->
    @if ($post->comments->isEmpty())
        <p>No comments yet. Be the first to comment!</p>
    @else
        <!-- Loop through and display each comment -->
        @foreach ($post->comments as $comment)
            <div class="comment">
                <!-- Display comment content -->
                <p>{{ $comment->content }}</p>
                <!-- Display the commenter's name (or 'Guest' if not registered) -->
                <p><small>- by {{ $comment->user ? $comment->user->name : 'Guest' }}</small></p>

                <!-- Form to delete a comment -->
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <!-- Delete button for the comment -->
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        @endforeach
    @endif

    <!-- Display success messages after successful actions -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Comment Form for submitting new comments -->
    <form action="{{ route('comments.store', $post) }}" method="POST" class="comment-form">
        @csrf
        <!-- Textarea for comment content -->
        <textarea name="content" rows="4" placeholder="Write your comment..." required></textarea>
        <!-- Submit button for comment form -->
        <button type="submit">Comment</button>
    </form>

</body>
</html>
