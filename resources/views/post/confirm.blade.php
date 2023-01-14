<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
        <div class="mx-4 sm:p-8">

            <form action="{{ route('post.complete') }}}}" method="post">
                @csrf
                <input type="hidden" name="title" value="{{ $inputs->title }}">
                <input type="hidden" name="category_id" value="{{ $inputs->category_id->name }}">
                <input type="hidden" name="post_type_id" value="{{ $inputs->post_type_id->name }}">
                <input type="hidden" name="prefecture_id" value="{{ $inputs->prefecture_id->name }}">
                <input type="hidden" name="body" value="{{ $inputs->body }}">
                <p>下記の内容をご確認の上送信ボタンを押してください</p>
                <p>内容を訂正する場合は戻るを押してください。</p>
                <dl class="confirm">
                    <dt>募集タイトル</dt>
                    <dd>{{ $inputs->title }}</dd>
                    <dt>スポーツ</dt>
                    <dd>{{ $inputs->category_id->name }}</dd>
                    <dt>募集タイプ</dt>
                    <dd>{{ $inputs->post_type_id->name }}</dd>
                    <dt>都道府県</dt>
                    <dd>{{ $inputs->prefecture_id->name }}</dd>
                    <dt>募集文</dt>
                    <dd>
                        {{ $inputs->body }}
                    </dd>
                    <dd class="confirm_btn">
                        <button type="submit" name="send">送　信</button>
                        <button type="submit" name="back" class="back_btn" value="back">戻　る</button>
                    </dd>
                </dl>
            </form>
        </div>
    </div>
</x-app-layout>
