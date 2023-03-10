@php
    $week = ['日', '月', '火', '水', '木', '金', '土'];
    $date = $post->created_at;
    $day = new DateTime($date);
    $dow = $day->format('w');
    // dd($msgs->isEmpty());
@endphp
<x-app-layout>
    <div class="pc_area_show">
        <div class="footer_wrap pc">
            <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
                <div class="mx-4 sm:p-8">

                    <x-message :message="session('message')" />

                    <div class="mt-2_5rem md:flex items-center mt-6 relative">
                        <div class="w-full flex flex-col pb-5 border-b-spons_blue border-b-4">
                            <span class="text-xl font-bold text-spons_blue">{{ $post->title }}</span>
                        </div>
                        @if (Auth::check())
                            @if ($post->user_id === Auth::id())
                                <ul class="flex absolute right-0">
                                    <li
                                        class="bg-gray-500 border-solid border border-gray-500 p-2 mb-6 rounded text-white font-bold mx-1 edit">
                                        <a href="{{ route('post.edit', $post) }}">編集</a>
                                    </li>
                                    <li
                                        class="bg-red-500 border-solid border border-red-500 p-2 mb-6 rounded text-white font-bold mx-1 destroy_btn">
                                        <form method="post" action="{{ route('post.destroy', $post) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onClick="return confirm('本当に削除しますか？');">削除</button>
                                        </form>
                                    </li>
                                </ul>
                            @elseif(Auth::user()->role === 2)
                                <div class="flex">
                                    <button type="submit" id="post-{{ $post->id }}"
                                        onClick="toggleBookmark( {{ $post->id }} )"
                                        data-is-bookmark="{{ Auth::user()->is_bookmark($post->id) ? true : false }}"
                                        class="bookmark_btn absolute right-14 border border-solid border-spons_blue p-2 mb-6 mr-2 rounded text-spons_blue font-bold text-xl">
                                        <i
                                            class="{{ Auth::user()->is_bookmark($post->id) ? 'fas fa-star' : 'far fa-star' }}"></i></button>
                                    <ul class="destroy_ul absolute right-0">
                                        <li
                                            class="bg-red-500 border-solid border border-red-500 p-2 mb-6 rounded text-white font-bold mx-1 destroy_btn">
                                            <form method="post" action="{{ route('post.destroy', $post) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onClick="return confirm('本当に削除しますか？');">削除</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <button type="submit" id="post-{{ $post->id }}"
                                    onClick="toggleBookmark( {{ $post->id }} )"
                                    data-is-bookmark="{{ Auth::user()->is_bookmark($post->id) ? true : false }}"
                                    class="bookmark_btn absolute right-0 border border-solid border-spons_blue p-2 mb-6 rounded text-spons_blue font-bold text-xl">
                                    <i
                                        class="{{ Auth::user()->is_bookmark($post->id) ? 'fas fa-star' : 'far fa-star' }}"></i></button>
                            @endif
                        @endif
                    </div>

                    @if ($post->updated_at > $post->created_at)
                        <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                            <p class="mr-8 font-bold text-gray-500" style="width: 100px;">更新日時</p>
                            <span
                                class="text-black text-xl font-bold">{{ $post->updated_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                        </div>
                    @endif

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">投稿日時</p>
                        <span
                            class="text-black text-xl font-bold">{{ $post->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集者</p>
                        <a href="{{ route('user.show', $post->user->id) }}">
                            @if ($post->user->profile_image === null)
                                <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                    class="mr-4" style="width: 40px;">
                            @elseif ($post->user->profile_image !== 'user_default.jpg')
                                <img src="{{ asset('/storage/profile_image/' . $post->user->profile_image) }}"
                                    class="mr-4" style="width: 40px;">
                            @else
                                <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}" class="mr-4"
                                    style="width: 40px;">
                            @endif
                        </a>
                        <span class="text-black text-xl font-bold"><a href="{{ route('user.show', $post->user->id) }}"
                                class="text-spons_blue hover:underline decoration-solid">{{ $post->user->name }}</a></span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">所属チーム</p>
                        <p>
                            @if ($post->user->team === null)
                                <span class="text-black text-xl font-bold">－</span>
                            @else
                                <span class="text-black text-xl font-bold">{{ $post->user->team }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">スポーツ</p>
                        <span class="text-black text-xl font-bold">{{ $post->category->name }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集タイプ</p>
                        <span class="text-black text-xl font-bold">{{ $post->post_type->name }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">都道府県</p>
                        <span class="text-black text-xl font-bold">{{ $post->prefecture->name }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集文</p>
                        <span class="text-black text-xl font-bold">{!! nl2br(e($post->body)) !!}</span>
                    </div>

                    @if ($post->image)
                        <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                            <p class="mr-8 font-bold text-gray-500" style="width: 100px;">画像</p>
                            <div>
                                <img src="{{ asset('/storage/images/' . $post->image) }}" style="max-width: 600px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>

    {{-- SP --}}
    <div class="sp_area_show">
        <div class="footer_wrap sp">
            <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
                <div class="mx-4 sm:p-8">

                    <x-message :message="session('message')" />

                    @if (Auth::check())
                        @if ($post->user_id === Auth::id())
                            <ul class="flex justify-center mt-2_5rem">
                                <li
                                    class="bg-gray-500 border-solid border border-gray-500 mb-6 p-2 rounded text-white font-bold mx-1 edit">
                                    <a href="{{ route('post.edit', $post) }}">編集</a>
                                </li>
                                <li
                                    class="bg-red-500 border-solid border border-red-500 mb-6 p-2 rounded text-white font-bold mx-1 destroy_btn">
                                    <form method="post" action="{{ route('post.destroy', $post) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onClick="return confirm('本当に削除しますか？');">削除</button>
                                    </form>
                                </li>
                            </ul>
                        @elseif(Auth::user()->role === 2)
                            <div class="flex justify-center mt-2_5rem">
                                <button type="submit" id="post-{{ $post->id }}"
                                    onClick="toggleBookmark( {{ $post->id }} )"
                                    data-is-bookmark="{{ Auth::user()->is_bookmark($post->id) ? true : false }}"
                                    class="bookmark_btn border border-solid border-spons_blue mb-6 p-2 mr-2 rounded text-spons_blue font-bold text-xl">
                                    <i
                                        class="{{ Auth::user()->is_bookmark($post->id) ? 'fas fa-star' : 'far fa-star' }}"></i></button>
                                <ul class="destroy_ul">
                                    <li class="bg-red-500 border-solid border absolute border-red-500 mb-6 p-2 rounded text-white font-bold mx-1 destroy_btn"
                                        style="top: 6px;">
                                        <form method="post" action="{{ route('post.destroy', $post) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onClick="return confirm('本当に削除しますか？');">削除</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <button type="submit" id="post-{{ $post->id }}"
                                onClick="toggleBookmark( {{ $post->id }} )"
                                data-is-bookmark="{{ Auth::user()->is_bookmark($post->id) ? true : false }}"
                                class="bookmark_btn absolute right-0 border border-solid border-spons_blue p-2 mb-6 rounded text-spons_blue font-bold text-xl">
                                <i
                                    class="{{ Auth::user()->is_bookmark($post->id) ? 'fas fa-star' : 'far fa-star' }}"></i></button>
                        @endif
                    @endif

                    <div class="md:flex items-center relative md:mt-6">
                        <div class="w-full flex flex-col pb-5 border-b-spons_blue border-b-4">
                            <span class="text-xl font-bold text-spons_blue">{{ $post->title }}</span>
                        </div>
                    </div>

                    @if ($post->updated_at > $post->created_at)
                        <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                            <p class="mr-8 font-bold text-gray-500" style="width: 100px;">更新日時</p>
                            <span
                                class="text-black text-xl font-bold">{{ $post->updated_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                        </div>
                    @endif

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">投稿日時</p>
                        <span
                            class="text-black text-xl font-bold">{{ $post->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集者</p>
                        <a href="{{ route('user.show', $post->user->id) }}">
                            @if ($post->user->profile_image !== 'user_default.jpg')
                                <img src="{{ asset('/storage/profile_image/' . $post->user->profile_image) }}"
                                    class="mr-4" style="width: 40px;">
                            @else
                                <img src="{{ asset('/profile_image/' . $post->user->profile_image) }}" class="mr-4"
                                    style="width: 40px;">
                            @endif
                        </a>
                        <span class="text-black text-xl font-bold"><a
                                href="{{ route('user.show', $post->user->id) }}"
                                class="text-spons_blue hover:underline decoration-solid">{{ $post->user->name }}</a></span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">所属チーム</p>
                        <p>
                            @if ($post->user->team === null)
                                <span class="text-black text-xl font-bold">－</span>
                            @else
                                <span class="text-black text-xl font-bold">{{ $post->user->team }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">スポーツ</p>
                        <span class="text-black text-xl font-bold">{{ $post->category->name }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集タイプ</p>
                        <span class="text-black text-xl font-bold">{{ $post->post_type->name }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">都道府県</p>
                        <span class="text-black text-xl font-bold">{{ $post->prefecture->name }}</span>
                    </div>

                    <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                        <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集文</p>
                        <span class="text-black text-xl font-bold">{!! nl2br(e($post->body)) !!}</span>
                    </div>

                    @if ($post->image)
                        <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                            <p class="mr-8 font-bold text-gray-500" style="width: 100px;">画像</p>
                            <div>
                                <img src="{{ asset('/images/' . $post->image) }}" style="max-width: 600px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</x-app-layout>
