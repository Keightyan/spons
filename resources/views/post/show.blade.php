@php
    $week = ['日', '月', '火', '水', '木', '金', '土'];
    $date = $post->created_at;
    $now = new DateTime($date);
    $day = $now->format('w');
@endphp

<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="md:flex items-center mt-6 relative">
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
                                    class="bg-red-500 border-solid border border-red-500 p-2 mb-6 rounded text-white font-bold mx-1 destroy">
                                    <form method="post" action="{{ route('post.destroy', $post) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onClick="return confirm('本当に削除しますか？');">削除</button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <button type="submit" id="post-{{ $post->id }}"
                                onClick="toggleBookmark( {{ $post->id }} )"
                                data-is-bookmark="{{ Auth::user()->is_bookmark($post->id) ? 'true' : 'false' }}"
                                class="bookmark_btn absolute right-0 border border-solid border-spons_blue p-2 mb-6 rounded text-spons_blue font-bold text-xl">
                                <i
                                    class="{{ Auth::user()->is_bookmark($post->id) ? 'fas fa-star' : 'far fa-star' }}"></i></button>
                        @endif
                    @endif
                </div>

                <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                    <p class="mr-8 font-bold text-gray-500" style="width: 100px;">投稿日時</p>
                    <span
                        class="text-black text-xl font-bold">{{ $post->created_at->format("Y年n月d日({$week[$day]}) H:i:s") }}</span>
                </div>

                <div class="mt-6 flex items-center border-dotted border-b-spons_blue border-b-2 pb-6">
                    <p class="mr-8 font-bold text-gray-500" style="width: 100px;">募集者</p>
                    <span class="text-black text-xl font-bold">{{ $post->user->name }}</span>
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
                            <img src="{{ asset('storage/images/' . $post->image) }}" style="max-width: 600px;">
                        </div>
                    </div>
                @endif

                @if (Auth::check())
                    @if ($post->user_id !== Auth::id())
                        <div class="mt-6 flex">
                            <button class="mt-4 mb-10 w-1/4 h-20 rounded bg-green-500" style="margin-inline: auto;">
                                <span class="text-xl text-white font-bold w-full">メッセージを送る
                            </button>
                        </div>
                    @endif
                @endif
            </div>
            </form>
        </div>
        <x-footer></x-footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        // ★ボタンがクリックされたら
        function toggleBookmark(post_id) {
            // 押されたボタンを特定
            let post = $("#post-" + post_id)

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            let path;
            let data;
            if ($(post).data('is-bookmark') === true) {
                // お気に入り解除
                path = "/unbookmark"
                data = {
                    _method: "delete"
                }
            } else {
                // お気に入り登録
                path = "/bookmark"
            }
            $.ajax({
                url: "/post/" + post_id + path,
                type: "POST",
                data: data,
                dataType: 'json',
                complete: function(res) {
                    console.log(res)
                    if (res.status === 200) {
                        // 星の色を入れ替える
                        $(post).find('i').attr('class', res.responseText === "added" ? "fas fa-star" :
                            "far fa-star")
                        // data-is_bookmarkを入れ替える
                        $(post).data('is-bookmark', res.responseText === "added" ? true : false)
                    }
                }
            })
        }
    </script>
</x-app-layout>
