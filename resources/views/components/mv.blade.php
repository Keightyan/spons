<div class="mv">
    <h2>スポーツでつながるSNS</h2>

    <div id="new_recruits">
        <p class="head">新着の募集<span>最新の募集から 5 件までが表示されます。</span></p>

        @foreach ($posts5 as $post)

            @php
                $week = ['日', '月', '火', '水', '木', '金', '土'];
                $date = $post->created_at;
                $day = new DateTime($date);
                $dow = $day->format('w');
            @endphp

            <div class="recruit">
                <a href="{{ route('post.show', $post) }}">
                    <p class="title">{{ $post->title }}
                        @if ($post->image)
                            <img src="{{ asset('/img/ico_isImage.png') }}" alt="画像有り"
                                style="display: inline; max-width: 30px; margin-left: 5px;">
                        @endif
                    </p>
                    <p class="info">
                        <span class="text-spons_blue">{{ $post->user->name }}</span>　
                        カテゴリ：<span class="font-bold">{{ $post->category->name }}</span>　
                        募集タイプ：<span class="font-bold">{{ $post->post_type->name }}</span>　
                        都道府県：<span class="font-bold">{{ $post->prefecture->name }}</span>
                        <br>
                        <span class="text-sm">投稿日時：{{ $post->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                    </p>

                </a>
            </div>
        @endforeach

        <div class="look_more_link">
            <a href="">
                <p class="look_more"></p>
            </a>
        </div>
    </div>
</div>
