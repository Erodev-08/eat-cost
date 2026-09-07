@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-3.5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-900 placeholder-gray-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 text-sm transition-colors shadow-2xs']) }}>
