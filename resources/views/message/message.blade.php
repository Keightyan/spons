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
                            @foreach ($post->messages as $message)
                                @php
                                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                                    $date = $message->created_at;
                                    $day = new DateTime($date);
                                    $dow = $day->format('w');
                                @endphp
                                <div class="message">
                                    <div class="flex my-10 py-10 relative">
                                        <a href="{{ route('user.show', $message->sender_user_id) }}"><img
                                                src="{{ asset('/storage/profile_image/' . $message->user->profile_image) }}"></a>
                                        <p class="ml-8 mr-auto mt-2 font-bold inline-block">
                                            <a href="{{ route('user.show', $message->sender_user_id) }}"
                                                class="text-spons_blue hover:underline decoration-solid">{{ $message->user->name }}</a><br>
                                            <span class="block mt-4 font-medium">{{ $message->body }}</span>
                                        </p>
                                        <p class="time absolute top-0 right-0">
                                            {{-- <img src="{{ asset('storage/profile_image/' . $post->user->profile_image) }}" class="inline mr-2" style="height: 35px;">
                                            <span
                                                class="text-spons_blue mr-6">{{ $post->user->name }}</span> --}}
                                            <span
                                                class="text-sm">送信日時：{{ $message->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
