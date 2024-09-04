<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage categories') }}
        </h2>
    </x-slot>
    <div  class="w-1/2 mx-auto text-white ">

    <form action="{{route('cataction')}}" method="POST">
        @csrf
        <div class="mt-4">
            <x-input-label for="add" :value="__('Provide a category name to add')" />
            <x-text-input id="add" class="block mt-1 w-2/5 h-10" type="text" name="add" :value="old('add')" required autofocus autocomplete="category" />
            <x-input-error :messages="$errors->get('add')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 w-24">
            {{ __('add category') }}
        </x-primary-button>
    </form>

    <form action="{{route('cataction')}}" method="POST">
        @csrf

        <div class="mt-4">
            <x-input-label for="delete" :value="__('Provide the category name to delete ')" />
            <x-text-input id="delete" class="block mt-1 w-2/5 h-10" type="text" name="delete" :value="old('delete')" required autofocus autocomplete="category" />
            <x-input-error :messages="$errors->get('delete')" class="mt-2" />
        </div>

        <x-primary-button class="mt-4 w-24">
            {{ __('delete category') }}
        </x-primary-button>
    </form>
    </div>
</x-app-layout>