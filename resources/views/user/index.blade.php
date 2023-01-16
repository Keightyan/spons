<x-app-layout>
    @foreach ($users as $user)
        <div class="relative">
            <div><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></div>
            @if (Auth::check())
                @if ($user->id !== Auth::id())
                    <button type="submit" id="user-{{ $user->id }}" onClick="toggleRelation( {{ $user->id }} )"
                        data-is-follow="{{ Auth::user()->is_following($user->id) ? true : false }}"
                        class="bookmark_btn absolute right-0 border border-solid border-spons_blue p-2 mb-6 rounded text-spons_blue font-bold text-xl">
                        <i
                            class="{{ Auth::user()->is_following($user->id) ? 'fas fa-star' : 'far fa-star' }}"></i></button>
                @endif
            @endif
        </div>
    @endforeach
</x-app-layout>
