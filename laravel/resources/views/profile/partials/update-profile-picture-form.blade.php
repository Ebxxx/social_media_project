<form method="POST" action="{{ route('profile.update.picture') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full" accept="image/*">
        @error('profile_picture')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Update Picture') }}
        </x-button>
    </div>
</form>
