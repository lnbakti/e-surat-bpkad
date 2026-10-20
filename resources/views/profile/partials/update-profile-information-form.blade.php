<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                id="name"
                type="text"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                :value="$user->name"
                disabled
            />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                type="text"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                :value="preg_replace('/(.{2}).+(@.+)/', '$1****$2', $user->email)"
                disabled
            />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}
                </p>
            @endif
        </div>
    </div>
</section>
