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

                    <section id="messages">
                        <div>
                            @foreach ($messages as $message)
                                @php
                                    $posts = \App\models\Message::where('sender_user_id', $message->sender_user_id)
                                        ->where('post_id', $message->post_id)
                                        ->get();
                                @endphp
                                @foreach ($posts as $post)
                                    {{-- <?php dd($message->receiver_user_id); ?> --}}
                                    <?php $titles = \App\Models\Post::where('title', $post->post->title)->get(); ?>
                                    <div class="user relative">
                                        @if ($message->receiver_user_id === Auth::user()->id)
                                            <a href="{{ route('message.users', ['post' => $message->post_id]) }}">
                                                <div
                                                    style="border-bottom: 1px dotted #1A89DA;
                                        padding-bottom: 10px;
                                        padding-top: 5px;">
                                                    <div class="mb-4 flex">
                                                        <p class="mr-4 font-bold">
                                                            {{ $post->post->title }}
                                                        </p>
                                                    </div>
                                                    <p class="text-sm"><span class="mr-2">カテゴリ：<span
                                                                class="font-bold">{{ $message->post->category->name }}</span></span>
                                                        <span class="mr-2">募集タイプ：<span
                                                                class="font-bold">{{ $message->post->post_type->name }}</span></span>
                                                        <span class="mr-2">都道府県：<span
                                                                class="font-bold">{{ $message->post->prefecture->name }}</span></span>
                                                    </p>
                                                </div>
                                            </a>
                                        @elseif($message->sender_user_id === Auth::user()->id)
                                            <a
                                                href="{{ route('message.message', ['post' => $message->post_id, 'user' => $message->sender_user_id]) }}">
                                                <div
                                                    style="border-bottom: 1px dotted #1A89DA;
                                        padding-bottom: 10px;
                                        padding-top: 5px;">
                                                    <div class="mb-4 flex">
                                                        <p class="mr-4 font-bold">
                                                            {{ $post->post->title }}
                                                        </p>
                                                    </div>
                                                    <p class="text-sm"><span class="mr-2">カテゴリ：<span
                                                                class="font-bold">{{ $message->post->category->name }}</span></span>
                                                        <span class="mr-2">募集タイプ：<span
                                                                class="font-bold">{{ $message->post->post_type->name }}</span></span>
                                                        <span class="mr-2">都道府県：<span
                                                                class="font-bold">{{ $message->post->prefecture->name }}</span></span>
                                                    </p>
                                                </div>
                                            </a>
                                        @endif
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
