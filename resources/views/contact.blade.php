@extends('layouts.plantilla')

@section('title', 'Contacto | Eat-Cost')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xs border border-gray-200/80 dark:border-gray-800 p-6 sm:p-8 transition-colors">

            {{-- Header --}}
            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-xl border border-emerald-100 dark:border-emerald-800/60">
                    <i class="ri-mail-send-line"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900 dark:text-white">Contacto</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Si tienes dudas o sugerencias, escríbenos.</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-750">
                    <div class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">
                        <i class="ri-mail-line text-emerald-600 dark:text-emerald-400 mr-1"></i> Correo
                    </div>
                    <a class="text-sm font-semibold text-emerald-700 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 hover:underline transition-colors" href="mailto:contacto@eat-cost.com">
                        contacto@eat-cost.com
                    </a>
                </div>

                <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-750">
                    <div class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">
                        <i class="ri-time-line text-emerald-600 dark:text-emerald-400 mr-1"></i> Horario
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-300 font-medium">Lunes a viernes, 9:00 a 18:00</div>
                </div>
            </div>
        </div>
    </div>
@endsection
