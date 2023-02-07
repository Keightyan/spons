<x-app-layout>
    <div class="footer_wrap pc sp">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 pt-2rem">

                <x-message :message="session('message')" />

                <div class="items-center mt-6 relative">
                    <p class="search_head pc sp text-spons_blue text-3xl font-bold"><i class="fas fa-search"></i>
                        募集投稿を探す<br class="br_sp"><span>24時間以内の更新 or 投稿には<span class="new">NEW</span>が付きます。</span></p>
                    <div class="search_box pc sp my-5">
                        <form action="" id="form-new-search-box-basic" class="basic_search" method="get">
                            <ul class="tables pc sp">
                                <li class="selector pc sp">
                                    <div class="in_table pc sp">
                                        <div class="tr pc sp">
                                            <div class="tit pc sp">カテゴリ</div>
                                            <div class="selects pc sp"><select name="category_id">
                                                    <option value="all_categories">すべてのカテゴリ</option>
                                                    @foreach ($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}"{{ Request::get('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select></div>
                                        </div>
                                        <div class="tr pc sp">
                                            <div class="tit pc sp">募集タイプ</div>
                                            <div class="selects pc sp"><select name="post_type_id">
                                                    <option value="all_post_types">すべての募集タイプ</option>
                                                    @foreach ($post_types as $post_type)
                                                        <option
                                                            value="{{ $post_type->id }}"{{ Request::get('post_type_id') == $post_type->id ? 'selected' : '' }}>
                                                            {{ $post_type->name }}
                                                        </option>
                                                    @endforeach
                                                </select></div>
                                        </div>
                                        <div class="tr pc sp">
                                            <div class="tit pc sp">都道府県</div>
                                            <div class="selects pc sp"><select name="prefecture_id">
                                                    <option value="all_prefectures">すべての都道府県</option>
                                                    @foreach ($prefectures as $prefecture)
                                                        <option
                                                            value="{{ $prefecture->id }}"{{ Request::get('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                                                            {{ $prefecture->name }}
                                                        </option>
                                                    @endforeach
                                                </select></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="btns pc sp">
                                    <input type="submit" class="btn pc sp" value="検索" name="search">
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div id="recruits">
                        @if (!$request->has('search'))
                            {{-- 初期表示10件 --}}
                            @foreach ($posts10 as $post)
                                @php
                                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                                    $date = $post->created_at;
                                    $day = new DateTime($date);
                                    $dow = $day->format('w');
                                    
                                    $now_carbon_updated_at = new \Carbon\Carbon($post->updated_at);
                                    $now_carbon_created_at = new \Carbon\Carbon($post->created_at);
                                    
                                    $h24_carbon_updated_at = new \Carbon\Carbon($post->updated_at);
                                    $h24_carbon_updated_at->subHours(24);
                                    
                                    $h24_carbon_created_at = new \Carbon\Carbon($post->created_at);
                                    $h24_carbon_created_at->subHours(24);
                                    
                                    // dd($h24_carbon_updated_at);
                                    
                                @endphp

                                <div class="recruit">
                                    <a href="{{ route('post.show', $post) }}">
                                        {{-- 24時間以内の更新 or 投稿には「NEW」を付ける --}}
                                        <p
                                            class="{{ $now_carbon_updated_at <= $h24_carbon_updated_at || $now_carbon_created_at <= $h24_carbon_created_at ? 'title_currentp1' : 'title' }}">
                                            {{ $post->title }}
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
                                                <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                    class="inline mr-2" style="height: 35px;">
                                            @endif
                                            <span class="mr-6 text-spons_blue">{{ $post->user->name }}</span>
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
                            <div class="mt-16">
                                {{ $posts10->appends(request()->query())->links('vendor.pagination.tailwind2') }}</div>
                        @else
                            {{-- 検索結果 --}}
                            @foreach ($data as $post)
                                @if ($loop->index === 0)
                                    <div class="text-center border border-1 border-spons_blue py-2">
                                        カテゴリ：<span
                                            class="font-bold mr-6">{{ $request->category_id === 'all_categories' ? 'すべてのカテゴリ' : $post->category->name }}</span>
                                        募集タイプ：<span
                                            class="font-bold mr-6">{{ $request->post_type_id === 'all_post_types' ? 'すべての募集タイプ' : $post->post_type->name }}</span>
                                        都道府県：<span
                                            class="font-bold mr-6">{{ $request->prefecture_id === 'all_prefectures' ? 'すべての都道府県' : $post->prefecture->name }}</span>での検索結果
                                    </div>
                                @endif
                                @php
                                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                                    $date = $post->created_at;
                                    $day = new DateTime($date);
                                    $dow = $day->format('w');
                                    
                                    $now_carbon_updated_at = new \Carbon\Carbon($post->updated_at);
                                    $now_carbon_created_at = new \Carbon\Carbon($post->created_at);
                                    
                                    $h24_carbon_updated_at = new \Carbon\Carbon($post->updated_at);
                                    $h24_carbon_updated_at->subHours(24);
                                    
                                    $h24_carbon_created_at = new \Carbon\Carbon($post->created_at);
                                    $h24_carbon_created_at->subHours(24);
                                @endphp
                                <div class="recruit">
                                    <a href="{{ route('post.show', $post) }}">
                                        {{-- 24時間以内の更新 or 投稿には「NEW」を付ける --}}
                                        <p
                                            class="{{ $now_carbon_updated_at <= $h24_carbon_updated_at || $now_carbon_created_at <= $h24_carbon_created_at ? 'title_currentp1' : 'title' }}">
                                            {{ $post->title }}
                                            @if ($post->image)
                                                <img src="{{ asset('/img/ico_isImage.png') }}" alt="画像有り"
                                                    style="display: inline; max-width: 30px; margin-left: 5px;">
                                            @endif
                                            <p class="info">
                                                @if ($post->user->profile_image === null)
                                                    <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                        class="inline mr-2" style="height: 35px;">
                                                @elseif ($post->user->profile_image !== 'user_default.jpg')
                                                    <img src="{{ asset('/storage/profile_image/' . $post->user->profile_image) }}"
                                                        class="inline mr-2" style="height: 35px;">
                                                @else
                                                    <img src="{{ asset('/profile_image/' . 'user_default.jpg') }}"
                                                        class="inline mr-2" style="height: 35px;">
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
