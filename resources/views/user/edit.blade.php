<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-input-error class="mb-4" :messages="$errors->all()" />

                <form method="post" action="{{ route('user.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <p class="mr-8 font-bold" style="width: 100px;">プロフィール<br>画像</p>
                    <div>
                        @if ($user->profile_image)
                            <div class="mb-2">
                                （画像ファイル：{{ $user->profile_image }}）
                            </div>
                            <img src="{{ asset('storage/profile_image/' . $user->profile_image) }}" class="mx-auto mb-4"
                                style="height:200px;">
                        @endif
                        <input type="file" name="profile_image">
                    </div>

                    <div class="mt-8 my-10 flex">
                        <p class="mr-8 font-bold" style="width: 100px;">ニックネーム</p>
                        <p><input type="text" name="name"
                                class="w-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                placeholder="ニックネームを入力してください" value="{{ old('name', $user->name) }}"></p>
                    </div>
                    
                    <div class="mb-10 flex">
                        <p class="mr-8 font-bold" style="width: 100px;">都道府県</p>
                        <select class="bg-gray-200 rounded" name="prefecture_id">
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" @if ($prefecture->id === $user->prefecture_id) selected @endif>
                                    {{ $prefecture->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10 flex">
                        <p class="mr-8 font-bold" style="width: 100px;">所属チーム</p>
                        <p>
                            <input type="text" name="team"
                                class="w-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                placeholder="所属チームを入力してください"
                                value="{{ old('team', $user->team === null ? '－' : $user->team) }}">
                        </p>
                    </div>

                    <div class="mb-10 flex">
                        <p class="mr-8 font-bold" style="width: 100px;">性別</p>
                        <select class="bg-gray-200 rounded" name="gender">
                            <option
                                value="{{ $user->gender }}"{{ Request::get('gender') == $user->gender ? 'selected' : '' }}>
                                {{ $user->gender === 1 ? '男' : '女' }}</option>
                        </select>
                    </div>

                    <div class="mt-8 my-10 flex">
                        <p class="mr-8 font-bold" style="width: 100px;">生年月日</p>
                        <p><input type="text" name="birthday"
                                class="w-auto py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                placeholder="生年月日を入力してください" value="{{ old('birthday', $user->birthday) }}"></p>
                    </div>

                    <div class="mt-8 my-10 flex">
                        <p class="mr-12 font-bold" style="width: 100px;">興味のある<br>スポーツ</p>
                        <p class="w-full"><input type="text" name="favorites"
                                class="py-2 placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                                value="{{ old('favorites', $user->favorites) }}" style="width: 100%;"></p>
                    </div>

                    <div class="mb-10 flex">
                        <p class="mr-12 font-bold" style="width: 100px;">自己紹介</p>
                        <textarea name="introduction" class="w-full placeholder-gray-500 border border-gray-300 rounded-md bg-gray-200"
                            cols="30" rows="10" placeholder="自己紹介を入力してください">{{ old('introduction', $user->introduction) }}</textarea>
                    </div>

                    <div class="mb-10 flex">
                        <div class="mr-20"></div>
                        <button class="mt-4 mb-10 w-full h-20 rounded bg-spons_blue" style="margin-left: 3.3rem;">
                            <span class="text-xl text-white font-bold w-full">更新完了
                        </button>
                    </div>
            </div>
            </form>
        </div>
        <x-footer></x-footer>
    </div>
</x-app-layout>
