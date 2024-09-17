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
        <select class="bg-[#1F2937]" name="parent_id">
            <option value="">Select Parent Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <x-primary-button class="mt-4 w-24">
            {{ __('add category') }}
        </x-primary-button>
    </form>

    <table class="min-w-full  divide-y bg-[#1F2937]>
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>

            </tr>
        </thead>
        <tbody class="bg-[#1F2937] divide-y divide-gray-200">
            @foreach($categories as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $category->name }}</td>
                    @php
                        // dd($category->parent);
                    @endphp
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">  {{$category->parent->name ?? 'NO PARENT'}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"> 
                        <form action="{{route('cataction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="delete" value="{{$category->name}}"/>
                            <x-primary-button class="mt-4 w-24">
                                {{ __('delete category') }}
                            </x-primary-button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</x-app-layout>