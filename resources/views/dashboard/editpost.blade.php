<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit a Post') }}
        </h2>
    </x-slot>
    <div  class="w-1/2 mx-auto text-white ">

    @if (!request()->query('url'))
    <form method="GET">
        <div class="mt-4">
            <x-input-label for="url" :value="__('Provide the post url')" />
            <x-text-input id="url" class="block mt-1 w-2/5 h-10" type="text" name="url" :value="old('url')" required autofocus autocomplete="tags" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 w-24">
            {{ __('Submit') }}
        </x-primary-button>
        
    </form>
    @else 
     <form class="flex-col flex justify-center " method="POST" action="{{ route('editpost.do') }}">
        @csrf
        <div class="w-1/2">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$post[0]->title}}"  required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
   
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <x-text-input id="content" class="block mt-1 w-full h-20" type="text" name="content" value="{{$post[0]->content}}" required autofocus autocomplete="content" />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <input type="hidden" name="url" value="{{$post[0]->url}}"/>
  
        <div class="mt-4">
            <x-input-label for="tags" :value="__('Tags(seprate with commas(,) )')" />
            <x-text-input id="tags" class="block mt-1 w-2/5 h-10" type="text" name="tags" value="{{$post[0]->tags}}" required autofocus autocomplete="tags" />
            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
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
   
        <x-primary-button class="mt-10 w-24">
            {{ __('Submit') }}
        </x-primary-button>
        
        
        
    </form>
    @endif
    </div>
</x-app-layout>