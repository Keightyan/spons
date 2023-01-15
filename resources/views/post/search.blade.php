<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="items-center mt-6 relative">
                    <p class="text-spons_blue text-3xl font-bold"><i class="fas fa-search"></i> 募集投稿を探す</p>
                    <div class="search_box my-5">
                        <form action="" id="form-new-search-box-basic" class="basic_search"
                            method="get">
                            <ul class="tables">
                                <li class="selector">
                                    <input id="input_order" type="hidden" name="order" value="">
                                    <div class="in_table">
                                        <div class="tr">
                                            <div class="tit">カテゴリ</div>
                                            <div class="selects"><select name="category_id">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                                </select></div>
                                        </div>
                                        <div class="tr">
                                            <div class="tit">募集タイプ</div>
                                            <div class="selects"><select name="post_type_id">
                                                @foreach ($post_types as $post_type)
                                                <option value="{{ $post_type->id }}">{{ $post_type->name }}</option>
                                            @endforeach
                                                </select></div>
                                        </div>
                                        <div class="tr">
                                            <div class="tit">都道府県</div>
                                            <div class="selects"><select name="prefecture_id">
                                                @foreach ($prefectures as $prefecture)
                                                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                                            @endforeach
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
