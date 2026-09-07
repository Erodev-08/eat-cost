<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 font-semibold text-xs rounded-xl border border-gray-200 transition-colors cursor-pointer']) }}>
    {{ $slot }}
</button>
