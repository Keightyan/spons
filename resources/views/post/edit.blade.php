<x-app-layout>
    <div class="pc_area_form">
        <div class="footer_wrap">
            <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
                <div class="mx-4 sm:p-8">

                    <x-input-error class="mb-4" :messages="$errors->all()" />

                    <form method="post" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="md:flex items-center mt-8">
                            <div class="w-full flex flex-col pb-5 border-b-spons_blue border-b-4">
                                <input type="text" name="title"
                                    class="w-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                    placeholder="募集タイトルを入力してください" value="{{ old('title', $post->title) }}">
                            </div>
                        </div>

                        <div class="mt-8 my-10 flex">
                            <p class="mr-8 font-bold" style="width: 100px;">募集者</p>
                            <p>{{ $user->name }}</p>
                        </div>
                        {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

                        <div class="mb-10 flex">
                            <p class="mr-8 font-bold" style="width: 100px;">所属チーム</p>
                            <p>
                                @if ($user->team === null)
                                    －
                                @else
                                    {{ $user->team }}
                                @endif
                            </p>
                        </div>

                        <div class="mb-10 flex">
                            <p class="mr-8 font-bold" style="width: 100px;">スポーツ</p>
                            <select class="w-1/4 bg-gray-200 rounded" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($category->id === $post->category_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-10 flex">
                            <p class="mr-8 font-bold" style="width: 100px;">募集タイプ</p>
                            <select class="w-1/4 bg-gray-200 rounded" name="post_type_id">
                                @foreach ($post_types as $post_type)
                                    <option value="{{ $post_type->id }}"
                                        @if ($post_type->id === $post->post_type_id) selected @endif>
                                        {{ $post_type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-10 flex">
                            <p class="mr-8 font-bold" style="width: 100px;">都道府県</p>
                            <select class="w-1/4 bg-gray-200 rounded" name="prefecture_id">
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{ $prefecture->id }}"
                                        @if ($prefecture->id === $post->prefecture_id) selected @endif>
                                        {{ $prefecture->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-10 flex">
                            <p class="mr-12 font-bold" style="width: 100px;">募集文</p>
                            <textarea name="body" class="w-full placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                cols="30" rows="10" placeholder="募集文を入力してください">{{ old('body', $post->body) }}</textarea>
                        </div>

                        <div class="mb-10 flex">
                            <p class="mr-8 font-bold" style="width: 100px;">画像</p>
                            <div>
                                @if ($post->image)
                                    <div class="mb-2">
                                        （画像ファイル：{{ $post->image }}）
                                    </div>
                                    <img src="{{ asset('storage/images/' . $post->image) }}" class="mx-auto mb-4"
                                        style="height:300px;">
                                @endif
                                <input type="file" name="image">
                            </div>
                        </div>

                        <div class="mb-10 flex">
                            <div class="mr-20"></div>
                            <button class="mt-4 mb-10 w-full h-20 rounded bg-spons_blue" style="margin-left: 3.3rem;">
                                <span class="text-xl text-white font-bold w-full">更新する
                            </button>
                        </div>
                </div>
                </form>
            </div>
            <x-footer></x-footer>
        </div>
    </div>


    {{-- SP --}}

    <div class="sp_area_form">
        <div class="footer_wrap sp">
            <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
                <div class="mx-4 sm:p-8">

                    <x-input-error class="mb-4" :messages="$errors->all()" />

                    <form method="post" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="md:flex items-center mt-8">
                            <div class="w-full flex flex-col pb-5 border-b-spons_blue border-b-4">
                                <input type="text" name="title"
                                    class="w-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                    placeholder="募集タイトルを入力してください" value="{{ old('title', $post->title) }}">
                            </div>
                        </div>

                        <div class="mt-10 my-12">
                            <p class="mr-8 font-bold mb-2">募集者</p>
                            <p>{{ $user->name }}</p>
                        </div>
                        {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

                        <div class="mb-12">
                            <p class="mr-8 font-bold mb-2">所属チーム</p>
                            <p>
                                @if ($user->team === null)
                                    －
                                @else
                                    {{ $user->team }}
                                @endif
                            </p>
                        </div>

                        <div class="mb-12">
                            <p class="mr-8 font-bold mb-2">スポーツ</p>
                            <select class="w-1/4 bg-gray-200 rounded" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($category->id === $post->category_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-12">
                            <p class="mr-8 font-bold mb-2">募集タイプ</p>
                            <select class="w-1/4 bg-gray-200 rounded" name="post_type_id">
                                @foreach ($post_types as $post_type)
                                    <option value="{{ $post_type->id }}"
                                        @if ($post_type->id === $post->post_type_id) selected @endif>
                                        {{ $post_type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-12">
                            <p class="mr-8 font-bold mb-2">都道府県</p>
                            <select class="w-1/4 bg-gray-200 rounded" name="prefecture_id">
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{ $prefecture->id }}"
                                        @if ($prefecture->id === $post->prefecture_id) selected @endif>
                                        {{ $prefecture->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-12">
                            <p class="mr-12 font-bold mb-2">募集文</p>
                            <textarea name="body" class="w-full placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                cols="30" rows="10" placeholder="募集文を入力してください">{{ old('body', $post->body) }}</textarea>
                        </div>

                        <div class="mb-12">
                            <p class="mr-8 font-bold mb-2">画像</p>
                            <div>
                                @if ($post->image)
                                    <div class="mb-2">
                                        （画像ファイル：{{ $post->image }}）
                                    </div>
                                    <img src="{{ asset('storage/images/' . $post->image) }}" class="mx-auto mb-4"
                                        style="height:300px;">
                                @endif
                                <input type="file" name="image">
                            </div>
                        </div>

                        <div class="mb-12">
                            <div class="mr-20"></div>
                            <button class="mt-4 mb-10 w-full h-20 rounded bg-spons_blue">
                                <span class="text-xl text-white font-bold w-full">更新する
                            </button>
                        </div>
                </div>
                </form>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
</x-app-layout>
