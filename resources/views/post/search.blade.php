{{-- @php
    $week = ['日', '月', '火', '水', '木', '金', '土'];
    $date = $post->created_at;
    $day = new DateTime($date);
    $dow = $day->format('w');
@endphp --}}

<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="items-center mt-6 relative">
                    <p class="text-spons_blue text-3xl font-bold"><i class="fas fa-search"></i> 募集投稿を探す</p>
                    <div class="search_box my-5">
                        <form action="/recruits/url/search" id="form-new-search-box-basic" class="basic_search"
                            method="get">
                            <ul class="tables">
                                <li class="selector">
                                    <input id="input_order" type="hidden" name="order" value="">
                                    <div class="in_table">
                                        <div class="tr">
                                            <div class="tit">カテゴリ</div>
                                            <div class="selects"><select name="category_id">
                                                    <option value="">すべてのカテゴリ</option>
                                                    <option value="soccer">サッカー</option>
                                                    <option value="futsal">フットサル</option>
                                                    <option value="baseball">野球</option>
                                                    <option value="softball">ソフトボール</option>
                                                    <option value="golf">ゴルフ</option>
                                                    <option value="tennis">テニス</option>
                                                    <option value="padel">パデル</option>
                                                    <option value="basketball">バスケットボール</option>
                                                    <option value="rugby">ラグビー</option>
                                                    <option value="volleyball">バレーボール</option>
                                                    <option value="amefoot">アメリカンフットボール</option>
                                                    <option value="badminton">バドミントン</option>
                                                    <option value="handball">ハンドボール</option>
                                                    <option value="pingpong">卓球</option>
                                                    <option value="cricket">クリケット</option>
                                                    <option value="lacrosse">ラクロス</option>
                                                    <option value="dodgeball">ドッジボール</option>
                                                    <option value="gateball">ゲートボール</option>
                                                    <option value="bowling">ボウリング</option>
                                                    <option value="squash">スカッシュ</option>
                                                    <option value="billiard">ビリヤード</option>
                                                    <option value="jog">ランニング・マラソン</option>
                                                    <option value="athletic">陸上</option>
                                                    <option value="swimming">水泳</option>
                                                    <option value="fitness">フィットネス</option>
                                                    <option value="yoga">ヨガ</option>
                                                    <option value="gymnastics">体操</option>
                                                    <option value="dance">ダンス</option>
                                                    <option value="cycling">サイクリング</option>
                                                    <option value="shooting">射撃</option>
                                                    <option value="darts">ダーツ</option>
                                                    <option value="ski">スキー</option>
                                                    <option value="snowboard">スノーボード</option>
                                                    <option value="figure">フィギュアスケート</option>
                                                    <option value="fieldhockey">フィールドホッケー</option>
                                                    <option value="icehockey">アイスホッケー</option>
                                                    <option value="sumo">相撲</option>
                                                    <option value="judo">柔道</option>
                                                    <option value="kendo">剣道</option>
                                                    <option value="karate">空手</option>
                                                    <option value="boxing">ボクシング</option>
                                                    <option value="fencing">フェンシング</option>
                                                    <option value="muaythai">ムエタイ</option>
                                                    <option value="wrestling">レスリング</option>
                                                    <option value="martialarts">総合格闘技</option>
                                                    <option value="taekwondo">テコンドー</option>
                                                    <option value="motorsports">モータースポーツ</option>
                                                    <option value="f1">F1</option>
                                                    <option value="streetsoccer">ストリートサッカー</option>
                                                    <option value="sepaktakraw">セパタクロー</option>
                                                    <option value="outdoor">アウトドアスポーツ</option>
                                                    <option value="surfing">サーフィン</option>
                                                    <option value="olympics">オリンピック</option>
                                                </select></div>
                                        </div>
                                        <div class="tr">
                                            <div class="tit">募集タイプ</div>
                                            <div class="selects"><select name="post_type_id">
                                                    <option value="">すべてのタイプ</option>
                                                    <option value="opponent">対戦相手</option>
                                                    <option value="individual">個人参加</option>
                                                    <option value="member">メンバー募集</option>
                                                    <option value="join_team">チームに入りたい</option>
                                                    <option value="join_circle">サークルに入りたい</option>
                                                    <option value="online_event">オンラインイベント</option>
                                                </select></div>
                                        </div>
                                        <div class="tr">
                                            <div class="tit">都道府県</div>
                                            <div class="selects"><select name="prefecture_id">
                                                    <option value="">すべての都道府県</option>
                                                    <option value="hokkaido">北海道</option>
                                                    <option value="aomori">青森</option>
                                                    <option value="iwate">岩手</option>
                                                    <option value="miyagi">宮城</option>
                                                    <option value="akita">秋田</option>
                                                    <option value="yamagata">山形</option>
                                                    <option value="fukushima">福島</option>
                                                    <option value="ibaraki">茨城</option>
                                                    <option value="tochigi">栃木</option>
                                                    <option value="gunma">群馬</option>
                                                    <option value="saitama">埼玉</option>
                                                    <option value="chiba">千葉</option>
                                                    <option value="tokyo">東京</option>
                                                    <option value="kanagawa">神奈川</option>
                                                    <option value="niigata">新潟</option>
                                                    <option value="toyama">富山</option>
                                                    <option value="ishikawa">石川</option>
                                                    <option value="fukui">福井</option>
                                                    <option value="yamanashi">山梨</option>
                                                    <option value="nagano">長野</option>
                                                    <option value="gifu">岐阜</option>
                                                    <option value="shizuoka">静岡</option>
                                                    <option value="aichi">愛知</option>
                                                    <option value="mie">三重</option>
                                                    <option value="shiga">滋賀</option>
                                                    <option value="kyoto">京都</option>
                                                    <option value="osaka">大阪</option>
                                                    <option value="hyogo">兵庫</option>
                                                    <option value="nara">奈良</option>
                                                    <option value="wakayama">和歌山</option>
                                                    <option value="tottori">鳥取</option>
                                                    <option value="shimane">島根</option>
                                                    <option value="okayama">岡山</option>
                                                    <option value="hiroshima">広島</option>
                                                    <option value="yamaguchi">山口</option>
                                                    <option value="tokushima">徳島</option>
                                                    <option value="kagawa">香川</option>
                                                    <option value="ehime">愛媛</option>
                                                    <option value="kochi">高知</option>
                                                    <option value="fukuoka">福岡</option>
                                                    <option value="saga">佐賀</option>
                                                    <option value="nagasaki">長崎</option>
                                                    <option value="kumamoto">熊本</option>
                                                    <option value="oita">大分</option>
                                                    <option value="miyazaki">宮崎</option>
                                                    <option value="kagoshima">鹿児島</option>
                                                    <option value="okinawa">沖縄</option>
                                                    <option value="overseas">海外</option>
                                                </select></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="area_tags">
                                </li>
                                <li class="btns">
                                    <input type="submit" class="btn" name="search" value="検索">
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div id="recruits">
                        @foreach ($posts as $post)
                            @php
                                $week = ['日', '月', '火', '水', '木', '金', '土'];
                                $date = $post->created_at;
                                $day = new DateTime($date);
                                $dow = $day->format('w');
                            @endphp

                            <div class="recruit">
                                <a href="{{ route('post.show', $post) }}">
                                    <p class="{{ $posts->currentPage() === 1 ? 'title_currentp1' : 'title' }}">{{ $post->title }}
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
                                        <span
                                            class="text-sm">投稿日時：{{ $post->created_at->format("Y年n月d日({$week[$dow]}) H:i:s") }}</span>
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{ $posts->links('vendor.pagination.tailwind2') }}
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
