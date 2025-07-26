<x-guest-layout>
    <!-- Session Status -->
    <!-- Login Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input
                    id="email"
                    style="color: black"
                    class="block mt-1 w-full bg-white text-black border border-black rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="email"
                    name="email"
                    required
                    autofocus
                />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />
            </div>

            <!-- Password -->
            <div class="relative mt-4">
                <x-input-label for="login_password" :value="__('Password')" />
                <input
                    id="login_password"
                    class="block mt-1 w-full bg-white border border-gray-300 rounded-md text-black focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password"
                    name="password"
                    required
                />
                <button
                    type="button"
                    class="absolute top-7 right-2 text-gray-600"
                    onclick="togglePassword('login_password', this)"
                >
                    <i class="fa-solid fa-eye"></i>
                </button>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        name="remember"
                    />
                    <span class="ml-2 text-sm text-gray-600"
                    >{{ __("Remember me") }}</span
                    >
                </label>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __("Log in") }}
                </x-primary-button>
            </div>
        </form>
    </div>
    </div>
    </div>
</x-guest-layout>
