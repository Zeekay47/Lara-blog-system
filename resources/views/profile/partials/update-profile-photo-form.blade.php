{{-- resources/views/profile/partials/update-profile-photo-form.blade.php --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Photo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your profile photo.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        {{-- Current Profile Photo --}}
        <div class="flex items-center space-x-4">
            <div class="shrink-0">
                <img class="h-20 w-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Current profile photo') }}
                </p>
            </div>
        </div>

        {{-- Upload Form --}}
        <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf
            @method('post')

            <div>
                <x-input-label for="profile_photo" :value="__('Choose new photo')" />
                <x-text-input
                    id="profile_photo"
                    name="profile_photo"
                    type="file"
                    class="mt-1 block w-full"
                    accept="image/jpeg,image/png,image/jpg,image/gif"
                />
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    {{ __('Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB.') }}
                </p>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Upload Photo') }}</x-primary-button>

                @if (session('status') === 'profile-photo-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Uploaded.') }}</p>
                @endif
            </div>
        </form>

        {{-- Delete Photo Form --}}
        @if($user->profile_photo)
            <form method="post" action="{{ route('profile.photo.delete') }}" class="mt-4">
                @csrf
                @method('delete')
                <x-danger-button onclick="return confirm('Are you sure you want to delete your profile photo?')">
                    {{ __('Delete Photo') }}
                </x-danger-button>

                @if (session('status') === 'profile-photo-deleted')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400 mt-2"
                    >{{ __('Deleted.') }}</p>
                @endif
            </form>
        @endif
    </div>
</section>