
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile image") }}
        </p>
    </header>

    {{ $this->form }}

    <x-primary-button wire:click="update">Update</x-primary-button>

</section>
