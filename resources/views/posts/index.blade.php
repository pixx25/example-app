<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadata and Character Set for the page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>

    <!-- Include Bootstrap CSS from a CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles for the Page -->
    <style>
        /* General body styling with beige background and dark text */
        body {
            background-color: #F5F5DC; /* Beige background */
            color: #333; /* Dark text for contrast */
        }

        /* Styling for each card (post) */
        .card {
            border: none; /* Remove default border */
            border-radius: 10px; /* Add rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for card */
        }

        /* Card body styling with white background and padding */
        .card-body {
            background-color: #fff; /* White card background */
            border-radius: 10px;
            padding: 15px;
        }

        /* Custom button styling for the primary button */
        .btn-primary {
            background-color: #6B705C; /* Muted green button */
            border: none;
        }

        /* Button hover effect for the primary button */
        .btn-primary:hover {
            background-color: #A5A58D; /* Light beige-green hover */
        }

        /* Custom button styling for the secondary button */
        .btn-secondary {
            background-color: #DDA15E; /* Beige button */
            border: none;
        }

        /* Button hover effect for the secondary button */
        .btn-secondary:hover {
            background-color: #BC6C25; /* Warm brown hover */
        }

        /* Styling for the page heading */
        h1 {
            color: #6B705C; /* Muted green color for heading */
            font-family: 'Georgia', serif; /* Elegant serif font for heading */
        }

        /* Pagination styling */
        .pagination {
            margin-top: 20px; /* Space between content and pagination */
        }

        /* Styling individual pagination numbers */
        .pagination .page-link {
            color: #6B705C; /* Text color for pagination numbers */
            background-color: #F5F5DC; /* Beige background for pagination numbers */
            border: 1px solid #6B705C; /* Muted green border */
            border-radius: 5px; /* Rounded corners for pagination numbers */
        }

        /* Pagination hover effect */
        .pagination .page-link:hover {
            color: #fff; /* White text on hover */
            background-color: #6B705C; /* Muted green background on hover */
            border-color: #6B705C; /* Match border to background */
        }

        /* Styling for the active pagination item */
        .pagination .page-item.active .page-link {
            color: #fff; /* White text for active page */
            background-color: #6B705C; /* Muted green background for active page */
            border-color: #6B705C; /* Border color for active page */
        }
    </style>
</head>
<body class="container my-4">
    <!-- Page Heading -->
    <h1 class="mb-4 text-center">All Posts</h1>

    <!-- Displaying the posts in a responsive grid layout -->
    <div class="row">
        @foreach ($posts as $post) <!-- Loop through the posts passed from the controller -->
            <div class="col-md-4 mb-3">
                <!-- Card for each post -->
                <div class="card">
                    <div class="card-body">
                        <!-- Post Title -->
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <!-- Displaying the author's name or 'Unknown' if not available -->
                        <p class="card-text">By {{ $post->user->name ?? 'Unknown' }}</p>
                        <!-- Link to view the individual post -->
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">View Post</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }} <!-- Pagination using Bootstrap 4 style -->
    </div>

    <!-- Link to navigate back to the Welcome page -->
    <div class="text-center mt-4">
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Go Back to Welcome Page</a>
    </div>

    <!-- Include Bootstrap JS for interactivity (like dropdowns, modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
