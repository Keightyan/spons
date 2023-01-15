<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="items-center mt-6 relative">
                    <p class="text-spons_blue text-3xl font-bold"><i class="fas fa-search"></i> 募集投稿を探す</p>
                    <div class="search_box my-5">
                        <form action="" id="form-new-search-box-basic" class="basic_search" method="get">
                            @csrf
                            <ul class="tables">
                                <li class="selector">
                                    <div class="in_table">
                                        <div class="tr">
                                            <div class="tit">カテゴリ</div>
                                            <div class="selects"><select name="category_id">
                                                    <option value="all_categories">すべてのカテゴリ</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select></div>
                                        </div>
                                        <div class="tr">
                                            <div class="tit">募集タイプ</div>
                                            <div class="selects"><select name="post_type_id">
                                                    <option value="all_post_types">すべての募集タイプ</option>
                                                    @foreach ($post_types as $post_type)
                                                        <option value="{{ $post_type->id }}">{{ $post_type->name }}
                                                        </option>
                                                    @endforeach
                                                </select></div>
                                        </div>
                                        <div class="tr">
                                            <div class="tit">都道府県</div>
                                            <div class="selects"><select name="prefecture_id">
                                                    <option value="all_prefectures">すべての都道府県</option>
                                                    @foreach ($prefectures as $prefecture)
                                                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}
                                                        </option>
                                                    @endforeach
                                                </select></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="btns">
                                    <input type="submit" class="btn" value="検索" name="search">
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div id="recruits">
                        {{-- @php
                        dd();
                        @endphp --}}
                        @if (!$request->has('search'))
                            {{-- 初期表示10件 --}}
                            @foreach ($posts10 as $post)
                                @php
                                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                                    $date = $post->created_at;
                                    $day = new DateTime($date);
                                    $dow = $day->format('w');
                                @endphp

                                <div class="recruit">
                                    <a href="{{ route('post.show', $post) }}">
                                        <p class="{{ $posts10->currentPage() === 1 ? 'title_currentp1' : 'title' }}">
                                            {{ $post->title }}
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
                            <div class="mt-16">
                                {{ $posts10->appends(request()->query())->links('vendor.pagination.tailwind2') }}</div>
                        @else
                            {{-- 検索結果 --}}
                            @foreach ($data as $post)
                                @if ($loop->index == 0)
                                <div class="text-center border border-1 border-spons_blue py-2">
                                    カテゴリ：<span
                                        class="font-bold">{{ $request->category_id === 'all_categories' ? 'すべてのカテゴリ' : $post->category->name }}</span>　
                                    募集タイプ：<span
                                        class="font-bold">{{ $request->post_type_id === 'all_post_types' ? 'すべての募集タイプ' : $post->post_type->name }}</span>　
                                    都道府県：<span
                                        class="font-bold">{{ $request->prefecture_id === 'all_prefectures' ? 'すべての都道府県' : $post->prefecture->name }}</span>　での検索結果
                                    </div>
                                @endif
                            @endforeach
                            @foreach ($data as $post)
                                @php
                                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                                    $date = $post->created_at;
                                    $day = new DateTime($date);
                                    $dow = $day->format('w');
                                @endphp
                                <div class="recruit">
                                    <a href="{{ route('post.show', $post) }}">
                                        <p class="title">
                                            {{ $post->title }}
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
                            <div class="mt-16">
                                {{ $data->appends(request()->query())->links('vendor.pagination.tailwind2') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
