<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary btn border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 focus:bg-gray-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
