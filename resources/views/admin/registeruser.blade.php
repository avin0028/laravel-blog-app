<x-guest-layout>
    <form method="POST" action="{{ route('registeruser.store') }}">
        @csrf
        @php
     $selectedRole = 'viewer'; 
     @endphp
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        {{-- role --}}
      <div class="text-white">
        <input type="radio"  name="role"  value="writer" {{ $selectedRole == 'writer' ? 'checked' : '' }}> <label>Writer</label>
        <input type="radio"  name="role" value="editor" {{ $selectedRole == 'editor' ? 'checked' : '' }}> <label>Editor</label>
        <input type="radio"  name="role" value="viewer" {{ $selectedRole == 'viewer' ? 'checked' : '' }}> <label>Viewer</label>

      </div>

        <div class="flex items-center justify-end mt-4">
     

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
