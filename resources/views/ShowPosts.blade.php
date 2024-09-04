<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#111827] text-white">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Published Posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class=" bg-[#1F2937] rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-300 mb-4">{{ Str::limit($post->content, 20) }}</p>

                    <a href="{{ route('showpost', ['url' => $post->url]) }}" class="text-blue-500 hover:underline">Read more</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>