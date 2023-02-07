<x-app-layout>
    <div class="footer_wrap pc sp">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4">

                <x-message :message="session('message')" />

                <div class="md:flex items-center relative">
                    <div class="w-full flex flex-col pb-5">
                        <div class="profile_container md:flex justify-center">

                            <div class="profile-left md:mr-5 mt-8">
                                <div class="rounded-full mx-auto flex justify-center">
                                    @if ($user->profile_image === null)
                                        <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                            style="width: 200px;">
                                    @elseif ($user->profile_image !== 'user_default.jpg')
                                        <img src="{{ asset('/storage/profile_image/' . $user->profile_image) }}"
                                            style="width: 200px;">
                                    @else
                                        <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                            style="width: 200px;">
                                    @endif
                                </div>
                                <p class="text-lg font-bold text-center mt-4">{{ $user->name }}</p>
                                @if (Auth::check())
                                    @if (Auth::user()->role === 2 && $user->id !== 1)
                                        <ul class="destroy_ul flex justify-center mt-2">
                                            <li
                                                class="bg-red-500 border-solid border border-red-500 p-2 mb-6 rounded text-white font-bold mx-1 destroy_btn">
                                                <form method="post" action="{{ route('user.destroy', $user) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onClick="return confirm('本当に削除しますか？');">削除</button>
                                                </form>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($user->id !== Auth::id())
                                        <div class="mt-6 text-center">
                                            <a href="{{ route('message.inquiry', $user) }}"><button
                                                    class="msg_btn mt-4 mb-10 w-40 h-20 rounded bg-green-500"
                                                    style="margin-inline: auto;">
                                                    <span class="text-xl text-white font-bold w-full">メッセージを送る</span>
                                                </button></a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="profile-right ml-5 md:w-70per">
                                @if (Auth::check())
                                    @if ($user->id === Auth::id())
                                        <div class="text-right">
                                            <a href="{{ route('user.edit', $user) }}"><button
                                                    class="md:absolute md:right-6 border border-solid border-spons_blue p-2 mt-8 mb-6 mr-2 rounded text-spons_blue font-bold text-xl">
                                                    <i class="fas fa-cog"></i>
                                                </button></a>
                                        </div>
                                    @else
                                        <div class="flex relative user-{{ $user->id }} mt-8">
                                            <button type="submit" onClick="toggleRelation( {{ $user->id }} )"
                                                data-is-follow="{{ Auth::user()->is_following($user->id) ? true : false }}"
                                                class="{{ Auth::user()->is_following($user->id) ? 'absolute right-0 border border-solid border-spons_blue p-2 rounded font-bold text-xl bg-spons_blue text-white' : 'absolute right-0 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-white text-spons_blue' }}">
                                                <span>{{ Auth::user()->is_following($user->id) ? 'フォロー中' : 'フォロー' }}</span></button>
                                        </div>
                                    @endif
                                @endif
                                <div class="md:my-16 mt-0 mb-16">
                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">都道府県</p>
                                        @if ($user->prefecture_id === null)
                                            <span class="text-black text-xl font-bold">未設定</span>
                                        @else
                                            <span
                                                class="text-black text-xl font-bold">{{ $user->prefecture->name }}</span>
                                        @endif
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">所属チーム</p>
                                        @if ($user->team === null)
                                            <span class="text-black text-xl font-bold">－</span>
                                        @else
                                            <span class="text-black text-xl font-bold">{{ $user->team }}</span>
                                        @endif
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">性別</p>
                                        @if ($user->gender === null)
                                            <span class="text-black text-xl font-bold">未設定</span>
                                        @else
                                            <span
                                                class="text-black text-xl font-bold">{{ $user->gender == 1 ? '男' : '女' }}</span>
                                        @endif
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">年齢</p>
                                        @if ($user->birthday === null)
                                            <span class="text-black text-xl font-bold">未設定</span>
                                        @else
                                            <span class="text-black text-xl font-bold">
                                                @php
                                                    $birthday = new \Carbon\Carbon($user->birthday);
                                                @endphp
                                                {{ $birthday->age }} <span class="text-sm">歳</span>
                                            </span>
                                        @endif
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">興味のあるスポーツ</p>
                                        @if ($user->favorites === null)
                                            <span class="text-black text-xl font-bold">未入力</span>
                                        @else
                                            <span class="text-black text-xl font-bold">{{ $user->favorites }}</span>
                                        @endif
                                    </div>

                                    <div
                                        class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">自己紹介</p>
                                        @if ($user->introduction === null)
                                            <span class="text-black text-xl font-bold">未入力</span>
                                        @else
                                            <span class="text-black text-xl font-bold">{!! nl2br(e($user->introduction)) !!}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="tabs-menu">
                            <p class="mb-4"><span
                                    class=" text-spons_blue font-bold text-xl">{{ $user->name }}</span> さんの</p>
                            <li id="followings"><a
                                    href="#followings_content">フォロー中　{{ $user->followings()->count() }}</a></li>
                            <li id="followers"><a href="#followers_content">フォロワー　{{ $user->followers()->count() }}</a>
                            </li>
                            <li><a href="#posts">募集投稿　{{ $user->posts()->count() }}</a></li>
                            @if ($user->id === Auth::id())
                                <li><a href="#bookmarks">ブックマーク　{{ $user->bookmarks()->count() }}</a></li>
                            @endif
                        </ul>
                        <section class="tabs-content">
                            <section id="followings_content">
                                <div>
                                    @foreach ($user->followings as $following)
                                        <div class="flex my-10 relative following">
                                            <a href="{{ route('user.show', $following) }}">
                                                @if ($following->profile_image === null)
                                                    <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                        style="width: 100px;">
                                                @elseif ($following->profile_image !== 'user_default.jpg')
                                                    <img src="{{ asset('/storage/profile_image/' . $following->profile_image) }}"
                                                        style="width: 100px;">
                                                @else
                                                    <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                        style="width: 100px;">
                                                @endif
                                            </a>
                                            <p class="ml-4 mr-auto mt-2 font-bold"><a
                                                    href="{{ route('user.show', $following) }}"
                                                    class="text-spons_blue hover:underline decoration-solid">{{ $following->name }}</a><br>
                                                <span
                                                    class="block mt-4 font-medium">{{ $following->introduction }}</span>
                                                @if ($user->id === Auth::id())
                                                    <div class="user-{{ $following->id }}">
                                                        <button type="submit"
                                                            onClick="toggleRelation( {{ $following->id }} )"
                                                            data-is-follow="{{ Auth::user()->is_following($following->id) ? true : false }}"
                                                            class="{{ Auth::user()->is_following($following->id) ? 'absolute -right-4 border border-solid border-spons_blue p-2 rounded font-bold text-xl bg-spons_blue text-white' : 'absolute -right-4 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-white text-spons_blue' }}">
                                                            <span>{{ Auth::user()->is_following($following->id) ? 'フォロー中' : 'フォロー' }}</span></button>
                                                    </div>
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                            <section id="followers_content">
                                <div>
                                    @foreach ($user->followers as $follower)
                                        <div class="flex my-10 relative follower">
                                            <a href="{{ route('user.show', $follower) }}">
                                                @if ($follower->profile_image === null)
                                                    <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                        style="width: 100px;">
                                                @elseif ($follower->profile_image !== 'user_default.jpg')
                                                    <img src="{{ asset('/storage/profile_image/' . $follower->profile_image) }}"
                                                        style="width: 100px;">
                                                @else
                                                    <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                        style="width: 100px;">
                                                @endif
                                            </a>
                                            <p class="ml-4 mr-auto mt-2 font-bold"><a
                                                    href="{{ route('user.show', $follower) }}"
                                                    class="text-spons_blue hover:underline decoration-solid">{{ $follower->name }}</a><br>
                                                <span
                                                    class="block mt-4 font-medium">{{ $follower->introduction }}</span>
                                                @if ($user->id === Auth::id())
                                                    <div class="user-{{ $follower->id }}">
                                                        <button type="submit"
                                                            onClick="toggleRelation( {{ $follower->id }} )"
                                                            data-is-follow="{{ Auth::user()->is_following($follower->id) ? true : false }}"
                                                            class="{{ Auth::user()->is_following($follower->id) ? 'absolute -right-4 border border-solid border-spons_blue p-2 rounded font-bold text-xl bg-spons_blue text-white' : 'absolute -right-4 border border-solid border-spons_blue p-2 mb-10 rounded font-bold text-xl bg-white text-spons_blue' }}">
                                                            <span>{{ Auth::user()->is_following($follower->id) ? 'フォロー中' : 'フォロー' }}</span></button>
                                                    </div>
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                            <section id="posts">
                                <div>
                                    @foreach ($posts as $post)
                                        @php
                                            $week = ['日', '月', '火', '水', '木', '金', '土'];
                                            $date = $post->created_at;
                                            $day = new DateTime($date);
                                            $dow = $day->format('w');
                                            
                                            $post_carbon_updated_at = new \Carbon\Carbon($post->updated_at);
                                            $post_carbon_created_at = new \Carbon\Carbon($post->created_at);
                                            
                                            $h24ago_carbon_updated_at = \Carbon\Carbon::now();
                                            $h24ago_carbon_updated_at->subHours(24);
                                            
                                            $h24ago_carbon_created_at = \Carbon\Carbon::now();
                                            $h24ago_carbon_created_at->subHours(24);
                                        @endphp
                                        <div class="post">
                                            <a href="{{ route('post.show', $post) }}">
                                                {{-- 24時間以内の更新 or 投稿には「NEW」を付ける --}}
                                                <p
                                                    class="{{ $post_carbon_updated_at > $h24ago_carbon_updated_at || $post_carbon_created_at > $h24ago_carbon_created_at ? 'title_currentp1' : 'title' }}">
                                                    {{ $post->title }}
                                                    @if ($post->image)
                                                        <img src="{{ asset('/img/ico_isImage.png') }}" alt="画像有り"
                                                            style="display: inline; max-width: 30px; margin-left: 5px;">
                                                    @endif
                                                </p>
                                                <p class="info">
                                                    {{-- <img src="{{ asset('/profile_image/' . $post->user->profile_image) }}" class="inline mr-2" style="height: 35px;">
                                                        <span
                                                            class="text-spons_blue mr-6">{{ $post->user->name }}</span> --}}
                                                    カテゴリ：<span
                                                        class="font-bold mr-6">{{ $post->category->name }}</span>
                                                    募集タイプ：<span
                                                        class="font-bold mr-6">{{ $post->post_type->name }}</span>
                                                    都道府県：<span
                                                        class="font-bold mr-6">{{ $post->prefecture->name }}</span>
                                                    <br>
                                                    @if ($post->updated_at > $post->created_at)
                                                        <span
                                                            class="text-sm mr-6">更新日時：{{ $post->updated_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                                                    @endif
                                                    <span
                                                        class="text-sm">投稿日時：{{ $post->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                            @if ($user->id === Auth::id())
                                <section id="bookmarks">
                                    <div>
                                        @foreach ($user->bookmark_posts as $bookmark_post)
                                            @php
                                                $week = ['日', '月', '火', '水', '木', '金', '土'];
                                                $date = $bookmark_post->created_at;
                                                $day = new DateTime($date);
                                                $dow = $day->format('w');
                                                
                                                $post_carbon_updated_at = new \Carbon\Carbon($bookmark_post->updated_at);
                                                $post_carbon_created_at = new \Carbon\Carbon($bookmark_post->created_at);
                                                
                                                $h24ago_carbon_updated_at = \Carbon\Carbon::now();
                                                $h24ago_carbon_updated_at->subHours(24);
                                                
                                                $h24ago_carbon_created_at = \Carbon\Carbon::now();
                                                $h24ago_carbon_created_at->subHours(24);
                                            @endphp
                                            <div class="bookmark">
                                                <a href="{{ route('post.show', $bookmark_post) }}">
                                                    {{-- 24時間以内の更新 or 投稿には「NEW」を付ける --}}
                                                    <p
                                                        class="{{ $post_carbon_updated_at > $h24ago_carbon_updated_at || $post_carbon_created_at > $h24ago_carbon_created_at ? 'title_currentp1' : 'title' }}">
                                                        {{ $bookmark_post->title }}
                                                        @if ($bookmark_post->image)
                                                            <img src="{{ asset('/img/ico_isImage.png') }}"
                                                                alt="画像有り"
                                                                style="display: inline; max-width: 30px; margin-left: 5px;">
                                                        @endif
                                                        <p class="info">
                                                            @if ($bookmark_post->user->profile_image === null)
                                                                <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}" class="inline mr-2" style="height: 35px;">
                                                            @elseif ($bookmark_post->user->profile_image !== 'user_default.jpg')
                                                                <img src="{{ asset('/storage/profile_image/' . $bookmark_post->user->profile_image) }}" class="inline mr-2" style="height: 35px;">
                                                            @else
                                                                <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}" class="inline mr-2" style="height: 35px;">
                                                            @endif
                                                            <span
                                                                class="text-spons_blue mr-6">{{ $bookmark_post->user->name }}</span>
                                                            カテゴリ：<span
                                                                class="font-bold mr-6">{{ $bookmark_post->category->name }}</span>
                                                            募集タイプ：<span
                                                                class="font-bold mr-6">{{ $bookmark_post->post_type->name }}</span>
                                                            都道府県：<span
                                                                class="font-bold mr-6">{{ $bookmark_post->prefecture->name }}</span>
                                                            <br>
                                                            @if ($bookmark_post->updated_at > $bookmark_post->created_at)
                                                                <span
                                                                    class="text-sm mr-6">更新日時：{{ $bookmark_post->updated_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                                                            @endif
                                                            <span
                                                                class="text-sm">投稿日時：{{ $bookmark_post->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                                                        </p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
