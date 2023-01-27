<x-app-layout>
    <div class="top_footer_wrap pc sp">
        <x-message :message="session('message')" style="max-width: 940px; margin-inline: auto; margin-block: 20px;" />
        <div class="mv-new_recruits-container pc sp">
            <x-mv>
            </x-mv>
        </div>
        <x-top_footer></x-top_footer>
    </div>
</x-app-layout>
