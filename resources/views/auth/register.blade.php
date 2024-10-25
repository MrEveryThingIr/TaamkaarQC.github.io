<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center space-y-2 bg-slate-200 p-4 rounded-lg shadow-md">
                <img src="{{ asset('images/taamkarbrand.png') }}" alt="Tamkaar Logo" class="w-48 h-24 object-contain" />

                <h1 class="text-center text-3xl font-extrabold text-gray-800 tracking-tight">
                    تامکار تبلور توان ایرانی
                </h1>
            </div>
        </x-slot>



        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-label for="firstname" value="{{ __('First Name') }}" />
                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="given-name" />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="lastname" value="{{ __('Last Name') }}" />
                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autocomplete="family-name" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phonenumber" value="{{ __('Phone Number') }}" />
                <x-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" :value="old('phonenumber')" required autocomplete="tel" />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}" />
                <x-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autocomplete="organization-title" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
