<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Example</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom colors */
        .color-dark {
            background-color: #1F2937; /* Base color */
        }
        .color-darker {
            background-color: #111827; /* Darker color */
        }
    </style>
</head>
<body class="color-darker flex items-center justify-center min-h-screen">

    <div class="color-dark max-w-lg w-full text-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-dark mb-4">{{$post[0]->title}}</h1>
        <p class="text-base mb-4">{{$post[0]->content}}</p>
        <p class="text-base">You can customize the colors and styles further as per your requirements.</p>
    </div>

</body>
</html>
