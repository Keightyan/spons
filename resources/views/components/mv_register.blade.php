<div class="mv">
    <h2>スポーツでつながるSNS</h2>

    <div id="register_form">
        <p class="head">新規ユーザー登録</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                {{-- <x-input-label for="name" :value="__('Name')" /> --}}
                <x-text-input id="name"
                    class="mt-8 block w-4/5 mx-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                    type="text" name="name" :value="old('name')" required autofocus placeholder="名前" />

                    <p class="w-4/5 mx-auto mt-2">※10文字以下</p>

                <x-input-error :messages="$errors->get('name')" class="block w-4/5 mx-auto mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                <x-text-input id="email"
                    class="mt-6 block w-4/5 mx-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                    type="email" name="email" :value="old('email')" required placeholder="メールアドレス" />
                <x-input-error :messages="$errors->get('email')" class="block w-4/5 mx-auto mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                <x-text-input id="password"
                    class="mt-6 block w-4/5 mx-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                    type="password" name="password" required autocomplete="new-password" placeholder="パスワード" />

                    <p class="w-4/5 mx-auto mt-2">※8文字以上</p>

                <x-input-error :messages="$errors->get('password')" class="block w-4/5 mx-auto mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

                <x-text-input id="password_confirmation"
                    class="mt-6 block w-4/5 mx-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                    type="password" name="password_confirmation" required placeholder="パスワード確認" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="block w-4/5 mx-auto mt-2" />
            </div>


            <div class="mt-4 w-4/5 mx-auto text-center mb-8">
                <a class="no-underline hover:underline text-sm text-spons_blue font-bold hover:text-spons_blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spons_blue"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            <x-primary-button class="block mt-1 w-4/5 mx-auto py-2 border-red-500 rounded-md bg-red-500 text-white h-16 my-8">
                {{ __('Register') }}
            </x-primary-button>
        </form>
    </div>
</div>
