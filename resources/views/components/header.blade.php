<header>
    <div class="pc flexer">
        <h1><a href="{{ route('post.index') }}"><img src="{{ asset('/img/logo_spons.png') }}" alt="SpoNS（スポンズ）"></a></h1>

        <ul class="flex">
            <li><a href="{{ route('post.search') }}">募集を見る</a></li>
            @if (Auth::check())
                <li><a href="{{ route('post.create') }}">募集を投稿</a></li>
            @endif
        </ul>

        <a href="{{ route('post.search') }}"><i class="fas fa-search" alt="募集の検索"></i></a>

        <!-- ユーザー登録／ログイン後 -->
        @if (Auth::check())
            <a href=""><i class="fas fa-bell" alt="通知"></i></a>

            <a href="{{ route('message.index') }}"><i class="fas fa-envelope" alt="メッセージ"></i></a>

            <div class="followings_followers flex">
                <p class="followings"><a
                        href="{{ route('user.show', Auth::user()->id) }}#followings">{{ Auth::user()->followings()->count() }}</a>
                </p>
                <p class="followers"><a
                        href="{{ route('user.show', Auth::user()->id) }}#followers">{{ Auth::user()->followers()->count() }}</a>
                </p>
            </div>
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ml-20">
        @endif

        <!-- ユーザー登録／ログイン前 -->
        @if (!Auth::check())
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ml-8">
        @endif

        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                </div> --}}

            <!-- Navigation Links -->
            {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}

            <!-- Settings Dropdown -->
            @if (Auth::check())
                <div class="hidden sm:flex sm:items-center sm:ml-0">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="text-right" style="width: 80px;">
                                    @if (Auth::check())
                                        {{ Auth::user()->name }}
                                    @endif
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('user.show', Auth::user()->id)">マイページ
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('user.edit', Auth::user()->id)">プロフィールの編集
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <!-- ユーザー登録／ログイン前 -->
            @else
                <div class="before_auth">
                    {{-- <ul class="flex"> --}}
                    <span><a href="{{ route('login') }}">ログイン</a></span>
                    <span><a href="{{ route('register') }}">新規登録</a></span>
                    {{-- </ul> --}}
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif
                    </div>
                    <div class="font-medium text-sm text-gray-500">
                        @if (Auth::check())
                            {{ Auth::user()->email }}
                        @endif
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
        </nav>
    </div>

    <div class="pc_desc_cat">
        <div class="description pc">SpoNS（スポンズ）で、スポーツ仲間を見つけよう！</div>
        <div class="categories">
            <ul class="flex">
                @foreach ($categories as $category)
                    <li><a href="/posts/search?category_id={{ $category->id }}&post_type_id=all_post_types&prefecture_id=all_prefectures&search=検索"
                            class="a_895-1219"><img src="{{ asset("/img/{$category->image}") }}" class="pictogram"><br
                                class="br_895-1219"><span style="font-size: 1.5vw;">{{ $category->name }}</span></a>
                    </li>
                @endforeach
                {{-- <li><a href=""><img src="{{ asset('/img/ico_baseball.png') }}" class="pictogram">野球</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_softball.png') }}" class="pictogram">ソフトボール</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_soccer.png') }}" class="pictogram">サッカー</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_futsal.png') }}" class="pictogram">フットサル</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_tennis.png') }}" class="pictogram">テニス</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_badminton.png') }}" class="pictogram">バドミントン</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_basketball.png') }}" class="pictogram">バスケットボール</a></li>
        <li><a href=""><img src="{{ asset('/img/ico_golf.png') }}" class="pictogram">ゴルフ</a></li> --}}
                <li><a href="{{ route('post.search') }}" class="look_more"> >もっと見る</a></li>
            </ul>
        </div>
    </div>


    <div class="responsive">
        <h1><a href="{{ route('post.index') }}"><img src="{{ asset('/img/logo_spons.png') }}" alt="SpoNS（スポンズ）"></a>
        </h1>

        <ul>
            <li><a href="{{ route('post.search') }}">募集を見る</a></li>
            @if (Auth::check())
                <li><a href="{{ route('post.create') }}">募集を投稿</a></li>
            @endif
        </ul>

        <div class="responsive_icon">
            <div class="ico_search"><a href="{{ route('post.search') }}"><i class="fas fa-search"
                        alt="募集の検索"></i></a></div>

            <!-- ユーザー登録／ログイン後 -->
            @if (Auth::check())
                <a href=""><i class="fas fa-bell" alt="通知"></i></a>

                <a href="{{ route('message.index') }}"><i class="fas fa-envelope" alt="メッセージ"></i></a>

                <div class="followings_followers flex">
                    <p class="followings"><a
                            href="{{ route('user.show', Auth::user()->id) }}#followings">{{ Auth::user()->followings()->count() }}</a>
                    </p>
                    <p class="followers"><a
                            href="{{ route('user.show', Auth::user()->id) }}#followers">{{ Auth::user()->followers()->count() }}</a>
                    </p>
                </div>
                <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            @endif
        </div>

        <!-- ユーザー登録／ログイン前 -->
        @if (!Auth::check())
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ml-8">
        @endif

        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center h-16 relative">

                {{-- <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                </div> --}}

                <!-- Navigation Links -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}


                <!-- Settings Dropdown -->
                @if (Auth::check())
                    <div class="relative mt-4">
                        <x-responsive_dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div class="text-right">
                                        @if (Auth::check())
                                            {{ Auth::user()->name }}
                                        @endif
                                    </div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link :href="route('user.show', Auth::user()->id)">マイページ
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('user.edit', Auth::user()->id)">プロフィールの編集
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-responsive_dropdown>
                    </div>
                    <!-- ユーザー登録／ログイン前 -->
                @else
                    <div class="before_auth">
                        {{-- <ul class="flex"> --}}
                        <span><a href="{{ route('login') }}">ログイン</a></span>
                        <span><a href="{{ route('register') }}">新規登録</a></span>
                        {{-- </ul> --}}
                    </div>
            </div>
            @endif

            <!-- Hamburger -->
            {{-- <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> --}}
        </div>

        <!-- Responsive Navigation Menu -->
        {{-- <div :class="{ 'block': open, 'hidden': !open }">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div> --}}

        <!-- Responsive Settings Options -->
        {{-- <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif
                    </div>
                    <div class="font-medium text-sm text-gray-500">
                        @if (Auth::check())
                            {{ Auth::user()->email }}
                        @endif
                    </div>
                </div> --}}

        {{-- <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        </nav>
    </div>
    <div class="description sp">SpoNS（スポンズ）で、スポーツ仲間を見つけよう！</div>
    </div>
</header>
