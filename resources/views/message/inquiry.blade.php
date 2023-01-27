<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-input-error class="mb-4" :messages="$errors->all()" />
                <x-message :message="session('message')" />


                <form method="post" action="{{ route('message.store', $user) }}">
                    @csrf

                    {{-- <input type="hidden" name="post_id" value="{{ $post->id }}"> --}}
                    <input type="hidden" name="sender_user_id" value="{{ $from_id }}">
                    <input type="hidden" name="receiver_user_id" value="{{ $to_id }}">
                    
                    {{-- <div class="mt-8 mb-4 flex">
                        <p class="mr-8 font-bold" style="width: 100px;">募集タイトル</p>
                        <p class="text-spons_blue font-bold hover:underline decoration-solid mr-4"><a
                                href="{{ route('post.show', $post) }}">{{ $post->title }}</a></p>

                    </div>
                    <p class="text-sm"><span class="mr-2">カテゴリ：<span class="font-bold">{{ $post->category->name }}</span></span>
                        <span class="mr-2">募集タイプ：<span class="font-bold">{{ $post->post_type->name }}</span></span>
                        <span class="mr-2">都道府県：<span class="font-bold">{{ $post->prefecture->name }}</span></span></p> --}}

                    <div class="my-10 flex">
                        <p class="mr-12 font-bold" style="width: 100px;">メッセージ<br>内容</p>
                        <textarea name="body" class="w-full placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                            cols="30" rows="10" placeholder="メッセージを入力してください"></textarea>
                    </div>

                    <div class="mb-10 flex">
                        <div class="mr-20"></div>
                        <button class="mt-4 mb-10 w-full h-20 rounded bg-spons_blue" style="margin-left: 3.3rem;">
                            <span class="text-xl text-white font-bold w-full">送信する
                        </button>
                    </div>
            </div>
            </form>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
