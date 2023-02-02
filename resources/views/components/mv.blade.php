<div class="mv pc">
    <h2>スポーツでつながるSNS</h2>

    <div class="new_recruits pc sp">
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
                        @if ($post->user->profile_image === null)
                        <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                class="inline mr-2" style="height: 35px;">
                        @elseif ($post->user->profile_image !== 'user_default.jpg')
                            <img src="{{ asset('/storage/profile_image/' . $post->user->profile_image) }}"
                                class="inline mr-2" style="height: 35px;">
                        @else
                            <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}" class="inline mr-2"
                                style="height: 35px;">
                        @endif
                        <span class="text-spons_blue mr-6">{{ $post->user->name }}</span>
                        カテゴリ：<span class="font-bold mr-6">{{ $post->category->name }}</span>
                        募集タイプ：<span class="font-bold mr-6">{{ $post->post_type->name }}</span>
                        都道府県：<span class="font-bold mr-6">{{ $post->prefecture->name }}</span>
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

        <div class="look_more_link">
            <a href="{{ route('post.search') }}">
                <p class="look_more"></p>
            </a>
        </div>
    </div>
</div>


{{-- SP --}}
<div class="sp_area">

    <div class="mv sp">
        <h2>スポーツでつながるSNS</h2>
    </div>

    <div class="new_recruits sp">
        <p class="head">新着の募集<br class="br_sp"><span>最新の募集から 5 件までが表示されます。</span></p>

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
{{-- <?php dd($post->user->id); ?> --}}

                        @if ($post->user->profile_image === null)
                            <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}" class="inline mr-2"
                                style="height: 35px;">
                        @elseif ($post->user->profile_image !== 'user_default.jpg')
                            <img src="{{ asset('/storage/profile_image/' . $post->user->profile_image) }}"
                                class="inline mr-2" style="height: 35px;">
                        @else
                            <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}" class="inline mr-2"
                                style="height: 35px;">
                        @endif
                        <span class="text-spons_blue mr-6">{{ $post->user->name }}</span>
                        カテゴリ：<span class="font-bold mr-6">{{ $post->category->name }}</span>
                        募集タイプ：<span class="font-bold mr-6">{{ $post->post_type->name }}</span>
                        都道府県：<span class="font-bold mr-6">{{ $post->prefecture->name }}</span>
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

        <div class="look_more_link">
            <a href="{{ route('post.search') }}">
                <p class="look_more text-center">もっと見る</p>
            </a>
        </div>
    </div>
</div>
