<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="messages">
                    <div class="items-center mt-6 relative pb-5 border-b-spons_blue border-b-4">
                        <p class="search_head text-spons_blue text-3xl font-bold"><i class="fas fa-envelope"></i> メッセージ
                        </p>
                    </div>
                    <div class="mt-4 mb-4 flex">
                        <p class="font-bold" style="width: 100px;">募集タイトル</p>
                        <p class="text-spons_blue font-bold hover:underline decoration-solid mr-4"><a
                                href="{{ route('post.show', $post) }}">{{ $post->title }}</a></p>

                    </div>
                    <p class="text-sm"><span class="mr-2">カテゴリ：<span
                                class="font-bold">{{ $post->category->name }}</span></span>
                        <span class="mr-2">募集タイプ：<span class="font-bold">{{ $post->post_type->name }}</span></span>
                        <span class="mr-2">都道府県：<span class="font-bold">{{ $post->prefecture->name }}</span></span>
                    </p>

                    <section id="messages">
                        <div>
                            @foreach ($posts as $post)
                            @foreach($post->messages as $pm)
                                @php
                                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                                    $date = $post->created_at;
                                    $day = new DateTime($date);
                                    $dow = $day->format('w');
                                @endphp

                                <div class="user relative">
                                    <div class="user_msg_container">
                                        <a
                                            href="{{ route('message.message', ['post' => $post->id, 'user' => $pm->sender_user->id]) }}">
                                            <p class="mt-2 ml-8 pt-2 text-lg mr-auto">{{ $pm->sender_user->name }}</p>
                                            <p class="mt-4 ml-8 pb-2 font-medium text-2xl msg_body">
                                                {{ $pm->body }}</p>
                                        </a>
                                    </div>
                                    {{-- <p class="text-sm mt-2 absolute right-0">
                                                送信日時：{{ $message->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}
                                            </p> --}}

                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
