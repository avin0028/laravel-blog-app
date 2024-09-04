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
            <x-text-input id="url" class="block mt-1 w-2/5 h-10" type="text" name="url" :value="old('tags')" required autofocus autocomplete="tags" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 w-24">
            {{ __('Submit') }}
        </x-primary-button>
        
    </form>
    @endif 
    </div>
</x-app-layout>