<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/swal.css') }}">

        <title>Đăng nhập</title>

        {!! Assets::renderHeader(['core']) !!}
    </head>
    <body style="background-image: url({!! asset('images/main_bg.jpeg') !!});">
        <div class="grid grid-cols-12 gap-4">
            <div class="hidden sm:block sm:col-span-6 md:col-span-7 2xl:col-span-9 space-y-4">
                <div class="fixed left-0 bottom-0">
                    <div class="p-12 text-white">
                        <h1 class="text-4xl">Open Cart</h1>
                        <p>Copyright © Phan Trung Nguyên. Version 1.0</p>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 md:col-span-5 2xl:col-span-3 space-y-4">
                <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                    <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
                        <div class="mb-3">
                            <h3 class="uppercase">{{ __('Sign in below') }}:</h3>
                        </div>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input :dark="false" id="email"
                                         class="block mt-1 w-full"
                                         type="email"
                                         name="email"
                                         :value="old('email', env('DEFAULT_USERNAME'))" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         :dark="false"
                                         value="{{ env('DEFAULT_PASSWORD') }}"
                                         required autocomplete="current-password" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me?') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center mt-4">
                                <x-button>
                                    {{ __('Login') }}
                                </x-button>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

