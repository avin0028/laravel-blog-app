<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Confirm Comments') }}
        </h2>
    </x-slot>
    <body class="bg-gray-800 text-white">
        <div class="max-w-4xl mx-auto p-6 text-white">
            <h1 class="text-2xl font-bold mb-4">Pending Comments</h1>
    
            @if (session('success'))
                <div class="bg-green-500 p-2 rounded mb-4">{{ session('success') }}</div>
            @endif
    
            <table class="min-w-full bg-gray-700">
                <thead>
                    <tr>
                        <th class="py-2">User</th>
                        <th class="py-2">Comment</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td class="py-2">{{ $comment->user->name }}</td>
                            <td class="py-2">{{ $comment->content }}</td>
                            <td class="py-2">
                                <form action="{{ route('actioncomment', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="confirm"/>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Confirm</button>
                                </form>
                                <form action="{{ route('actioncomment', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="delete"/>
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>

</x-app-layout>