<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center py-2 px-6 my-2 bg-orange-400 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300']) }}>
    {{ $slot }}
</button>