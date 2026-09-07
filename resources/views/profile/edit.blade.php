<x-app-layout>

    {{-- Top Breadcrumb Header Bar --}}
    <div class="bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-xs">
            <a href="{{ route('dashboard') }}" class="text-emerald-700 font-bold uppercase tracking-wider hover:underline">Eat-Cost</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('profile.user') }}" class="text-gray-500 hover:text-emerald-700">Usuario</a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-800 font-semibold">Seguridad & Clave</span>
        </div>
        <div>
            <a href="{{ route('profile.user') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                <i class="ri-arrow-left-line"></i>
                Volver al Perfil
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        
        <div class="mb-2">
            <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i class="ri-lock-line text-emerald-600"></i>
                Perfil & Seguridad de Acceso
            </h1>
            <p class="text-xs text-gray-500 mt-0.5">
                Actualiza tus credenciales y contraseña de Eat-Cost
            </p>
        </div>

        <div class="p-6 bg-white shadow-xs border border-gray-200/80 rounded-2xl">
            <div class="flex items-center gap-2.5 mb-4">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                    <i class="ri-shield-keyhole-line"></i>
                </div>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Estado de Seguridad</h2>
            </div>

            <div class="space-y-3">
                @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && $user->hasVerifiedEmail())
                    <div class="flex items-start gap-2.5">
                        <div class="shrink-0 w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm mt-0.5">
                            <i class="ri-check-line font-bold"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Email Verificado</p>
                            <p class="text-[11px] text-gray-600 font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-start gap-2.5">
                        <div class="shrink-0 w-5 h-5 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-sm mt-0.5">
                            <i class="ri-alert-line font-bold"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="text-sm font-bold text-gray-900">Email No Verificado</p>
                                <form method="POST" action="{{ route('verification.send') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-bold text-emerald-700 hover:text-emerald-800 hover:underline">Verificar</button>
                                </form>
                            </div>
                            <p class="text-[11px] text-gray-600 font-medium truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                @endif

                <div class="flex items-start gap-2.5">
                    <div class="shrink-0 w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm mt-0.5">
                        <i class="ri-check-line font-bold"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Contraseña Segura</p>
                        <p class="text-[11px] text-gray-600 font-medium">Encriptación de nivel bancario</p>
                    </div>
                </div>

                <div class="flex items-start gap-2.5">
                    <div class="shrink-0 w-5 h-5 rounded-full {{ $profile && $profile->profile ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center text-sm mt-0.5">
                        <i class="{{ $profile && $profile->profile ? 'ri-check-line font-bold' : 'ri-information-line' }}"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Foto de Perfil</p>
                        <p class="text-[11px] text-gray-600 font-medium">{{ $profile && $profile->profile ? 'Foto personalizada' : 'Avatar automático' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow-xs border border-gray-200/80 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 bg-white shadow-xs border border-gray-200/80 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-white shadow-xs border border-gray-200/80 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</x-app-layout>
