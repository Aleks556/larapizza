<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-logo />
        </x-slot>

{{--        <x-jet-validation-errors class="mb-4" />--}}
        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">Ups! Coś poszło nie tak.</div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">


                        @error('name')
                            <li>Wprowadzone imię i nazwisko jest nieprawidłowe.</li>
                        @enderror

                        @error('email')
                            <li>Wprowadzony adres email jest nieprawidłowy.</li>
                        @enderror


                        @error('password')
                            <li>Hasło powinno składać się z minimum 8 znaków.</li>
                        @enderror

                        @error('confirmed')
                            <li>Wprowadzone hasła nie są takie same</li>
                        @enderror


                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="Imię i Nazwisko" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="Adres email" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="Hasło" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="Potwierdzenie hasła" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Posiadasz już u nas konto?
                </a>

                <x-jet-button class="ml-4">
                    Zarejestruj się
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
