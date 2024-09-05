<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Example</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
@php
    $tags = explode(',',$post[0]->tags);
@endphp
<body x-data="{ open: false }"  class="color-darker flex items-center justify-center min-h-screen">

    <div class="color-dark max-w-lg w-full text-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-dark mb-4">{{$post[0]->title}}</h1>
        <p class="text-base mb-4">{{$post[0]->content}}</p>
        <div class="w-full flex mb-4	">
            @foreach ($tags as $tag)
          <div class="text-black ml-2 rounded-md bg-gray-400">{{$tag}}</div>
                
            @endforeach
        </div>
        @hasrole('writer|editor|admin')
        <div>
            <button @click="open = true" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                Delete Post
            </button>
        </div>
        <div>
            <a href="{{Route('editpost',['url'=>$post[0]->url])}}"  class="px-2 py-1 bg-gray-500 text-white rounded hover:bg-gray-700">
               Edit Post
            </a>
        </div>
    </div>

    
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" style="display: none;">
        <div class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-lg z-10 w-1/3">
          
            <form action="{{ route('showpost.delete', ['url' => request()->route('url')]) }}" method="POST" class="p-4">
                @csrf
              <h4>Are you sure you want to delete this post?</h4>
              <div class="p-4 bg-gray-100 text-right">
                <input type="hidden" name="delete" value="post">
                <button type="submit" class="px-4 py-2 bg-red-300 rounded hover:bg-red-400">Delete</button>
                <button @click="open = false" class="px-4 py-2 bg-blue-300 rounded hover:bg-blue-400">Cancel</button>
 
              </form>
            </div>
            @endhasrole
           
        </div>    </div>

</body>
</html>
