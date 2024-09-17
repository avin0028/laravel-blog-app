<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit a Page') }}
        </h2>
    </x-slot>
    <div  class="w-1/2 mx-auto text-white ">

  
        @if (!request()->query('url'))
        <table class="min-w-full  divide-y bg-[#1F2937]>
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-[#1F2937] divide-y divide-gray-200">
                @foreach($pages as $page)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $page->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('editpage', ['url'=>$page->url]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else 
     <form class="flex-col flex justify-center " method="POST" action="{{ route('editpage.do') }}">
        @csrf
        <div class="w-1/2">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$page[0]->title}}"  required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
   
        <div class="mt-4">
            <x-input-label for="content" :value="__('Content')" />
            <x-text-input id="content" class="block mt-1 w-full h-20" type="text" name="content" value="{{$page[0]->content}}" required autofocus autocomplete="content" />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>
        <input type="hidden" name="url" value="{{$page[0]->url}}"/>


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