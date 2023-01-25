<div class="mv">
    <h2>スポーツでつながるSNS</h2>

    <div id="login_form">
        <p class="head">ログイン</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="post" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                <x-text-input id="email"
                    class="mt-8 block w-4/5 mx-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                    type="email" name="email" :value="old('email')" required autofocus placeholder="メールアドレス" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- <input type="text" name="title"
                                class="w-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                placeholder="募集タイトルを入力してください">
                        </div> --}}

            <!-- Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                <x-text-input id="password"
                    class="block mt-6 w-4/5 mx-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                    type="password" name="password" required autocomplete="current-password" placeholder="パスワード" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 w-4/5 mx-auto text-left">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-spons_blue shadow-sm focus:ring-spons_blue" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mt-4 w-4/5 mx-auto text-center mb-8">
                @if (Route::has('password.request'))
                    <a class="no-underline hover:underline text-sm text-spons_blue font-bold hover:text-spons_blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spons_blue"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <x-primary-button
                class="block mt-2 w-4/5 mx-auto py-2 border-spons_blue rounded-md bg-spons_blue text-white h-16">
                {{ __('Log in') }}
            </x-primary-button>

            <div class="border-b-4 border-gray-400 w-4/5 mx-auto text-center mt-8"></div>
        </form>
        <a href="{{ route('register') }}">
        <button class="block w-4/5 mx-auto py-2 border-red-500 rounded-md bg-red-500 text-white h-16 my-8">
            {{ __('Register') }}
        </button></a>
    </div>
</div>
