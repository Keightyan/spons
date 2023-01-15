@php
    $week = ['日', '月', '火', '水', '木', '金', '土'];
    $date = $post->created_at;
    $day = new DateTime($date);
    $dow = $day->format('w');
@endphp

<x-app-layout>
    <div class="footer_wrap">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1100px;">
            <div class="mx-4 sm:p-8">

                <x-message :message="session('message')" />

                <div class="md:flex items-center mt-6 relative">
                    <p class="text-spons_blue"><i class="fas fa-search"></i> 募集投稿を探す</p>
                    あ
                </div>
            </div>
            <x-footer></x-footer>
        </div>
</x-app-layout>
