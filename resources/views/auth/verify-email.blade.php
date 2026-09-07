<x-auth-layout>
    <div class="mb-5">
        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-2">
            <i class="ri-mail-check-line text-emerald-700"></i> Verificación
        </div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Verifica tu correo electrónico</h2>
        <p class="mt-1.5 text-xs text-gray-600 leading-relaxed font-medium">
            ¡Gracias por registrarte en Eat-Cost! Antes de comenzar, por favor verifica tu dirección de correo haciendo clic en el enlace que te acabamos de enviar. Si no recibiste el correo, con gusto te enviaremos otro.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-800 flex items-center gap-2">
            <i class="ri-checkbox-circle-fill text-emerald-600 text-base"></i>
            <span>Se ha enviado un nuevo enlace de verificación a tu correo.</span>
        </div>
    @endif

    <div class="mt-5 flex flex-col sm:flex-row items-center justify-between gap-3 pt-3 border-t border-gray-100">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit" class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs transition-colors cursor-pointer">
                Reenviar correo de verificación
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center sm:text-right">
            @csrf
            <button type="submit" class="text-xs font-bold text-gray-500 hover:text-red-600 transition-colors cursor-pointer">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-auth-layout>
