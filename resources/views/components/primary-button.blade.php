<button {{ $attributes->merge(['type' => 'submit', 'class' => 'block mt-1 w-4/5 mx-auto py-2 border-spons_blue rounded-md bg-spons_blue text-white']) }}>
    {{ $slot }}
</button>
