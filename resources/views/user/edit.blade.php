<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="md:flex items-center mt-6 relative">
                    <div class="w-full flex flex-col pb-5">
                        <div class="profile_container flex justify-center">
                            {{-- <img src="{{ asset('storage/images/' . $user->profile_image) }}" style="max-width: 600px;"> --}}
                            <div class="profile-left mr-5" style="width: 30%;">
                                <div class="rounded-full bg-gray-500 mx-auto" style="width: 200px; height: 200px;">
                                </div>
                                <p class="text-lg font-bold text-center mt-4">{{ $user->name }}</p>
                                @if (Auth::check())
                                    @if ($user->id !== Auth::id())
                                        <div class="mt-6 flex">
                                            <button class="msg_btn mt-4 mb-10 w-40 h-20 rounded bg-green-500"
                                                style="margin-inline: auto;">
                                                <span class="text-xl text-white font-bold w-full">メッセージを送る
                                            </button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="profile-right ml-5" style="width: 70%;">
                                @if (Auth::check())
                                    @if ($user->id !== Auth::id())
                                        <div class="flex relative" id="user-{{ $user->id }}">
                                            <button type="submit" onClick="toggleRelation( {{ $user->id }} )"
                                                data-is-follow="{{ Auth::user()->is_following($user->id) ? true : false }}"
                                                class="{{ Auth::user()->is_following($user->id) ? 'absolute right-0 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-spons_blue text-white' : 'absolute right-0 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-white text-spons_blue' }}">
                                                <span>{{ Auth::user()->is_following($user->id) ? 'フォロー中' : 'フォロー' }}</span></button>
                                        </div>
                                    @endif
                                @endif
                                <div class="my-16">
                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">都道府県</p>
                                        <span class="text-black text-xl font-bold">{{ $user->prefecture }}</span>
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">性別</p>
                                        <span class="text-black text-xl font-bold">{{ $user->gender }}</span>
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">所属チーム</p>
                                        <span class="text-black text-xl font-bold">
                                            @if ($user->team === null)
                                                <span class="text-black text-xl font-bold">－</span>
                                            @else
                                                <span class="text-black text-xl font-bold">{{ $user->team }}</span>
                                            @endif
                                        </span>
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">興味のあるスポーツ</p>
                                        <span class="text-black text-xl font-bold">{{ $user->favorites }}</span>
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">自己紹介</p>
                                        <span class="text-black text-xl font-bold">{!! nl2br(e($user->introduction)) !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="tabs-menu">
                            <li><a href="#tabs-1">フォロー中</a></li>
                            <li><a href="#tabs-2">フォロワー</a></li>
                            <li><a href="#tabs-3">募集投稿</a></li>
                            <li><a href="#tabs-4">ブックマーク</a></li>
                        </ul>
                        <section class="tabs-content">
                            <section id="tabs-1">
                                <p>フォロー中</p>
                            </section>
                            <section id="tabs-2">
                                <p>フォロワー</p>
                            </section>
                            <section id="tabs-3">
                                <p>募集投稿</p>
                            </section>
                            <section id="tabs-4">
                                <p>ブックマーク</p>
                            </section>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
