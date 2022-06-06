<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-3 py-1 bg-red-100 rounded-md text-red-600 border-2 border-red-600 text-md hover:bg-red-200']) }}>
    {{ $slot }}
</button>