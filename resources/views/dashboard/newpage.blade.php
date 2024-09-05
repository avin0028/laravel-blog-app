<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new page') }}
        </h2>
    </x-slot>
    <div class="w-1/2 mx-auto ">

    <form class="flex-col flex justify-center " method="POST" action="{{ route('newpage.store') }}">
        @csrf
        <div class="w-1/2">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
   
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <x-text-input id="content" class="block mt-1 w-full h-20" type="text" name="content" :value="old('content')" required autofocus autocomplete="content" />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="url" :value="__('Enter a custom url')" />
            <x-text-input id="url" class="block mt-1 w-1/5 h-10" type="text" name="url" :value="old('url')" required autofocus  />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="mt-4 text-white">
            <x-input-label for="status" :value="__('Select Status')" />
           
            <input type="radio" name="status" value="0" required>
            <label>Draft</label>
        
            <input type="radio" name="status" value="1" checked required>
            <label>Published</label>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
    </div>
    @if ($errors->any())
    <div class="text-white alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <x-primary-button class="mt-10 w-24">
            {{ __('Submit') }}
        </x-primary-button>
    </div>
</x-app-layout>