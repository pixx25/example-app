<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Blog</title>

    <!-- Importing Google Fonts (Poppins) for a clean and modern font style -->
    <style>
        /* Importing the 'Poppins' font with two weights */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* General body styling */
        body {
            font-family: 'Poppins', sans-serif; /* Apply 'Poppins' font to the body */
            margin: 0;
            padding: 0;
            display: flex; /* Use flexbox for centering content */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Make the body take full viewport height */
            background-color: #F5F5DC; /* Light beige background */
            position: relative; /* To position pseudo-elements correctly */
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        /* Styling for the left and right borders with a diagonal stripe pattern */
        body::before,
        body::after {
            content: ""; /* Empty content for the pseudo-elements */
            position: absolute; /* Position them outside the content */
            top: 0;
            height: 100%; /* Full height */
            width: 200px; /* Width of the stripe pattern */
            background-image: repeating-linear-gradient(
                45deg, /* Diagonal stripes */
                #007bff, /* Stripe color */
                #007bff 10px, /* Stripe width */
                transparent 10px, /* Space between stripes */
                transparent 20px
            );
            opacity: 0.1; /* Light opacity for a subtle effect */
        }

        /* Left side stripe styling */
        body::before {
            left: 0; /* Position the left stripe on the left side */
        }

        /* Right side stripe styling */
        body::after {
            right: 0; /* Position the right stripe on the right side */
        }

        /* Container for the main content */
        .container {
            text-align: center; /* Center text horizontally */
            background-color: white; /* White background for content */
            padding: 40px; /* Padding around the content */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow for a subtle lift */
            position: relative; /* Ensure the container stays above the pseudo-elements */
            z-index: 1; /* Make sure the container is above the background */
        }

        /* Heading styling */
        h1 {
            font-size: 32px; /* Larger font size for the main heading */
            font-weight: 600; /* Semi-bold text */
            margin-bottom: 20px; /* Space below the heading */
            color: #333; /* Dark gray text for readability */
        }

        /* Styling for the button */
        .button {
            background-color: #007bff; /* Blue background */
            color: white; /* White text */
            padding: 12px 24px; /* Adequate padding for the button */
            text-decoration: none; /* Remove underline from the link */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Standard font size for readability */
            font-weight: 600; /* Semi-bold text */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }

        /* Button hover effect */
        .button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>

    <!-- Main content container -->
    <div class="container">
        <!-- Main heading -->
        <h1>Welcome to My Blog!</h1>
        <!-- Button to navigate to the list of all posts -->
        <a href="{{ route('posts.index') }}" class="button">View All Posts</a>
    </div>

</body>
</html>
