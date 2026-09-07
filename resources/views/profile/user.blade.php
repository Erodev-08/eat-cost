<x-app-layout>

    {{-- Top Breadcrumb Header Bar --}}
    <div class="bg-white border-b border-gray-200 py-3 px-4 sm:px-6 flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="text-emerald-700 font-bold uppercase tracking-wider hover:underline">Eat-Cost</a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-600 font-medium">Usuario</span>
            <span class="text-gray-300">/</span>
            <span class="text-gray-900 font-bold">Mi Perfil</span>
        </div>
        <div class="flex items-center gap-2.5 ml-auto">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                Cuenta Activa
            </span>
            <button onclick="openModal()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors">
                <i class="ri-edit-line"></i>
                Editar Perfil
            </button>
        </div>
    </div>

    {{-- Toast Notification --}}
    @if (Session::has('status') || Session::has('error'))
        @php
            $isError = Session::has('error');
            $status = Session::get('status') ?? Session::get('error');
            $title = match($status) {
                'profile-updated' => 'Perfil Actualizado',
                'cover-updated' => 'Portada Actualizada',
                'image-deleted' => 'Foto Eliminada',
                'cover-deleted' => 'Portada Eliminada',
                default => $isError ? 'Atención' : 'Notificación'
            };
            $message = match($status) {
                'profile-updated' => 'Tu información de perfil se ha guardado exitosamente.',
                'cover-updated' => 'La imagen de portada ha sido actualizada.',
                'image-deleted' => 'Tu foto de perfil ha sido removida.',
                'cover-deleted' => 'La imagen de portada ha sido eliminada.',
                default => $status
            };
        @endphp
        <div id="toastNotification" class="fixed top-6 right-6 z-50 max-w-sm w-full bg-white shadow-xl rounded-2xl border border-gray-200 p-4 transform transition-all duration-300 translate-y-0 opacity-100 flex items-start gap-3">
            <div class="shrink-0 w-9 h-9 rounded-xl {{ $isError ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-700' }} flex items-center justify-center text-lg">
                <i class="{{ $isError ? 'ri-error-warning-fill' : 'ri-checkbox-circle-fill' }}"></i>
            </div>
            <div class="flex-1 min-w-0 pt-0.5">
                <h4 class="text-sm font-bold text-gray-900">{{ $title }}</h4>
                <p class="text-sm text-gray-600 mt-0.5 leading-relaxed">{{ $message }}</p>
            </div>
            <button onclick="closeToast()" class="text-gray-400 hover:text-gray-700 p-1">
                <i class="ri-close-line text-base"></i>
            </button>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gray-100 rounded-b-2xl overflow-hidden">
                <div id="toastProgress" class="h-full {{ $isError ? 'bg-red-500' : 'bg-emerald-600' }} transition-all duration-[4000ms] ease-linear w-full"></div>
            </div>
        </div>
    @endif

    @php
        $avatarUrl = $user->avatar_url;
        $coverUrl = $profile && $profile->cover_image 
            ? Storage::url($profile->cover_image) 
            : null;
        $userRole = ucfirst($user->rol ?? 'Estudiante');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        {{-- Cover & Hero Card Container --}}
        <div class="bg-white rounded-2xl shadow-xs border border-gray-200/80 overflow-hidden">
            
            {{-- Cover Banner --}}
            <div class="relative h-56 sm:h-72 lg:h-80 w-full overflow-hidden group">
                @if($coverUrl)
                    <img id="coverImageDisplay" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-102" src="{{ $coverUrl }}" alt="Portada">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent"></div>
                @else
                    {{-- Clean fresh green culinary gradient --}}
                    <div class="w-full h-full bg-gradient-to-r from-emerald-600 via-teal-600 to-green-700 relative overflow-hidden flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <div class="inline-flex p-3 rounded-2xl bg-white/20 backdrop-blur-xs mb-2">
                                <i class="ri-restaurant-2-line text-3xl"></i>
                            </div>
                            <p class="text-sm font-bold tracking-wider uppercase">Eat-Cost Recetario Pro</p>
                            <p class="text-sm text-emerald-100 mt-0.5">Personaliza tu perfil agregando una foto de portada</p>
                        </div>
                    </div>
                @endif

                {{-- Floating Cover Controls --}}
                <div class="absolute top-3 right-3 flex max-w-[calc(100%-1.5rem)] flex-wrap items-center justify-end gap-2 z-10">
                    <button onclick="openCoverModal()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-white/95 hover:bg-white text-gray-900 shadow-sm backdrop-blur-xs transition-colors">
                        <i class="ri-camera-line text-emerald-700 font-bold"></i>
                        <span>{{ $coverUrl ? 'Cambiar Portada' : 'Agregar Portada' }}</span>
                    </button>
                    @if($coverUrl)
                        <button onclick="confirmDeleteCover()" title="Eliminar portada" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-600 hover:bg-red-700 text-white shadow-sm transition-colors">
                            <i class="ri-delete-bin-line text-sm"></i>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Profile Header Details (Overlapping Avatar & Actions) --}}
            <div class="relative px-4 sm:px-8 lg:px-10 pb-8 pt-6">
                <div class="flex flex-col lg:flex-row items-center lg:items-end justify-between gap-6 mb-6">
                    
                    {{-- Avatar & Identity --}}
                    <div class="flex w-full min-w-0 flex-col sm:flex-row items-center sm:items-end gap-5 sm:gap-6 text-center sm:text-left z-20">
                        {{-- Avatar --}}
                        <div class="relative group shrink-0 -mt-16 lg:-mt-20">
                            <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-2xl ring-4 ring-white shadow-xl overflow-hidden bg-white relative">
                                <img id="profileImageDisplay" class="w-full h-full object-cover" src="{{ $avatarUrl }}" alt="{{ $user->name }}">
                                
                                {{-- Hover overlay --}}
                                <button onclick="openModal()" class="absolute inset-0 bg-black/50 text-white flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="ri-camera-line text-2xl"></i>
                                    <span class="text-sm font-bold mt-1">Cambiar</span>
                                </button>
                            </div>
                            
                            {{-- Edit badge --}}
                            <button onclick="openModal()" title="Editar foto" class="absolute -bottom-1 -right-1 w-9 h-9 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white shadow-md flex items-center justify-center ring-2 ring-white transition-colors">
                                <i class="ri-pencil-fill text-sm"></i>
                            </button>
                        </div>

                        {{-- Name, Email & Badges --}}
                        <div class="min-w-0 w-full space-y-3.5 pb-1 pt-2 sm:pt-0">
                            {{-- Línea 1: Nombre y Estado de Verificación --}}
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5 sm:gap-3">
                                <h1 class="min-w-0 max-w-full break-words text-2xl sm:text-3xl lg:text-3xl font-black text-gray-900 tracking-tight">
                                    {{ $user->name }}
                                </h1>
                                @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && $user->hasVerifiedEmail())
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-2xs">
                                        <i class="ri-shield-check-fill text-sm text-emerald-700"></i> Correo Verificado
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs">
                                        <i class="ri-error-warning-line text-sm text-amber-700"></i> Correo No Verificado
                                    </span>
                                @endif
                            </div>

                            {{-- Línea 2: Correo e Institución / Facultad --}}
                            <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center justify-center sm:justify-start gap-2.5 text-sm text-gray-600 font-medium">
                                <span class="inline-flex min-w-0 max-w-full items-start gap-1.5 text-left text-gray-800 bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">
                                    <i class="ri-mail-line text-emerald-700 text-base font-bold"></i>
                                    <span class="min-w-0 break-all">{{ $user->email }}</span>
                                </span>
                                @if($user->institution)
                                    <span class="text-gray-300 hidden sm:inline">•</span>
                                    <span class="inline-flex min-w-0 max-w-full items-start gap-1.5 text-left text-gray-700 bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">
                                        <i class="ri-building-line text-emerald-600 text-base"></i>
                                        <span class="break-words">{{ $user->institution }}</span>
                                    </span>
                                @endif
                            </div>

                            {{-- Línea 3: Rol y Fecha de Registro --}}
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-1">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    <i class="ri-user-star-line text-sm text-emerald-700"></i> {{ $userRole }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-semibold bg-gray-100 text-gray-700">
                                    <i class="ri-calendar-line text-sm text-gray-500"></i>
                                    Miembro desde {{ $user->created_at ? $user->created_at->format('M Y') : 'Reciente' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions Toolbar --}}
                    <div class="flex w-full lg:w-auto items-center gap-2.5 justify-center lg:justify-end shrink-0 pt-2 lg:pt-0">
                        <button onclick="openModal()" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm sm:text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors">
                            <i class="ri-edit-line text-base"></i>
                            <span>Editar Perfil</span>
                        </button>
                        <a href="{{ route('profile.configuracion') }}" title="Configuración" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors">
                            <i class="ri-settings-3-line text-lg"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- Stats & Key Metrics Row --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Stat 1: Recetas Creadas --}}
            <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-200/80 hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Recetas en Menú</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $recetasCount ?? 0 }}</h3>
                        <a href="{{ route('recetas') }}" class="inline-flex items-center text-sm font-bold text-emerald-700 hover:text-emerald-800 mt-1.5">
                            Ver catálogo <i class="ri-arrow-right-s-line ml-0.5"></i>
                        </a>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl border border-emerald-100">
                        <i class="ri-book-read-line"></i>
                    </div>
                </div>
            </div>

            {{-- Stat 2: Cálculos Realizados --}}
            <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-200/80 hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Costeos & Mermas</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $calculosCount ?? 0 }}</h3>
                        <a href="{{ route('recetas.elaboradas.index') }}" class="inline-flex items-center text-sm font-bold text-emerald-700 hover:text-emerald-800 mt-1.5">
                            Ver historial <i class="ri-arrow-right-s-line ml-0.5"></i>
                        </a>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl border border-teal-100">
                        <i class="ri-scales-3-line"></i>
                    </div>
                </div>
            </div>

            {{-- Stat 3: Institución --}}
            <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-200/80 hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 pr-2">
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Institución</p>
                        <h3 class="text-sm font-black text-gray-900 mt-1 truncate" title="{{ $user->institution ?? 'No especificada' }}">
                            {{ $user->institution ?? 'No asignada' }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1.5 font-medium">
                            {{ $user->institution ? 'Registrada' : 'Sin asignar' }}
                        </p>
                    </div>
                    <div class="w-11 h-11 shrink-0 rounded-xl bg-green-50 text-green-700 flex items-center justify-center text-xl border border-green-100">
                        <i class="ri-graduation-cap-line"></i>
                    </div>
                </div>
            </div>

            {{-- Stat 4: Antigüedad --}}
            <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-200/80 hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Miembro Desde</p>
                        <h3 class="text-base font-black text-gray-900 mt-1">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Reciente' }}
                        </h3>
                        <p class="text-sm text-emerald-700 font-bold mt-1.5">
                            <i class="ri-check-line"></i> Cuenta activa
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl border border-emerald-100">
                        <i class="ri-time-line"></i>
                    </div>
                </div>
            </div>

        </div>

        {{-- Main Details & Quick Hub Section (2 Columns) --}}
        <div class="grid grid-cols-1 gap-6">
            
            {{-- Left Column: User Detailed Profile Information (2 cols) --}}
            <div class="space-y-6">
                
                {{-- Account Details Card --}}
                <div class="hidden bg-white rounded-2xl shadow-xs border border-gray-200/80 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                                <i class="ri-user-settings-line"></i>
                            </div>
                            <h2 class="text-sm font-bold text-gray-900">Información de la Cuenta</h2>
                        </div>
                        <button onclick="openModal()" class="text-sm font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1">
                            <i class="ri-edit-line"></i> Actualizar
                        </button>
                    </div>

                    <div class="p-5">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">
                            
                            {{-- Name --}}
                            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                                <dt class="text-[11px] font-bold text-gray-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="ri-user-line text-emerald-700"></i> Nombre Completo
                                </dt>
                                <dd class="text-sm font-black text-gray-900 mt-1">
                                    {{ $user->name }}
                                </dd>
                            </div>

                            {{-- Email --}}
                            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                                <dt class="text-[11px] font-bold text-gray-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="ri-mail-check-line text-emerald-700"></i> Correo Electrónico
                                </dt>
                                <dd class="text-sm font-black text-gray-900 mt-1 flex items-center justify-between gap-2">
                                    <span class="truncate">{{ $user->email }}</span>
                                    <button onclick="copyToClipboard('{{ $user->email }}')" title="Copiar correo" class="text-gray-500 hover:text-gray-800">
                                        <i class="ri-file-copy-line text-sm"></i>
                                    </button>
                                </dd>
                            </div>

                            {{-- Institution --}}
                            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                                <dt class="text-[11px] font-bold text-gray-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="ri-hotel-line text-emerald-700"></i> Institución / Empresa
                                </dt>
                                <dd class="text-sm font-black text-gray-900 mt-1">
                                    {{ $user->institution ?? 'No asignada' }}
                                </dd>
                            </div>

                            {{-- Role --}}
                            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                                <dt class="text-[11px] font-bold text-gray-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="ri-shield-user-line text-emerald-700"></i> Rol en el Sistema
                                </dt>
                                <dd class="text-sm font-black text-gray-900 mt-1 capitalize">
                                    {{ $userRole }}
                                </dd>
                            </div>

                            {{-- User ID --}}
                            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                                <dt class="text-[11px] font-bold text-gray-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="ri-hashtag text-gray-500"></i> ID de Usuario
                                </dt>
                                <dd class="text-sm font-mono font-bold text-gray-900 mt-1">
                                    #{{ str_pad($user->id_usuario, 5, '0', STR_PAD_LEFT) }}
                                </dd>
                            </div>

                            {{-- Registration Date --}}
                            <div class="bg-gray-50 p-3.5 rounded-xl border border-gray-100">
                                <dt class="text-[11px] font-bold text-gray-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="ri-calendar-event-line text-emerald-700"></i> Fecha de Registro
                                </dt>
                                <dd class="text-sm font-black text-gray-900 mt-1">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </dd>
                            </div>

                        </dl>
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- ========================================================================= --}}
    {{-- MODAL 1: EDITAR PERFIL --}}
    {{-- ========================================================================= --}}
    <div id="editModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-xs transition-opacity" onclick="closeModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-200">
                
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                            <i class="ri-user-settings-line"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900" id="modal-title">Editar Perfil</h3>
                            <p class="text-[11px] text-gray-600 font-medium">Actualiza tus datos de usuario</p>
                        </div>
                    </div>
                    <button onclick="closeModal()" class="w-7 h-7 rounded-lg text-gray-500 hover:text-gray-800 hover:bg-gray-100 flex items-center justify-center transition-colors">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>

                <form id="profileUpdateForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="p-5 space-y-4">
                        
                        <div class="flex flex-col items-center pb-1">
                            <div class="relative group">
                                <img id="modalProfilePreview" class="w-20 h-20 rounded-2xl object-cover ring-2 ring-emerald-200 shadow-xs bg-gray-50" src="{{ $avatarUrl }}" alt="Preview">
                                <label for="imageUploadInput" class="absolute -bottom-1.5 -right-1.5 w-7 h-7 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white flex items-center justify-center cursor-pointer shadow-md ring-2 ring-white transition-colors">
                                    <i class="ri-camera-fill text-sm"></i>
                                </label>
                                <input type="file" id="imageUploadInput" name="profile_image" accept="image/*" class="hidden">
                            </div>
                            <p class="text-[11px] text-gray-600 font-medium mt-2 text-center">
                                Haz clic en la cámara para subir foto (JPG, PNG)
                            </p>
                            @if($profile && $profile->profile)
                                <button type="button" onclick="confirmDeleteProfileImage()" class="mt-1.5 text-[11px] font-bold text-red-600 hover:text-red-700 inline-flex items-center gap-1">
                                    <i class="ri-delete-bin-line"></i> Eliminar foto actual
                                </button>
                            @endif
                        </div>

                        <div>
                            <label for="inputUserName" class="block text-sm font-bold text-gray-800 uppercase tracking-wider mb-1">
                                Nombre Completo <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="inputUserName" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 rounded-xl border border-gray-300 bg-white text-gray-900 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            @error('name')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="inputUserEmail" class="block text-sm font-bold text-gray-800 uppercase tracking-wider mb-1">
                                Correo Electrónico <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="inputUserEmail" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 rounded-xl border border-gray-300 bg-white text-gray-900 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            @error('email')
                                <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="inputUserInstitution" class="block text-sm font-bold text-gray-800 uppercase tracking-wider mb-1">
                                Institución / Centro Educativo
                            </label>
                            <input type="text" id="inputUserInstitution" name="institution" value="{{ old('institution', $user->institution) }}" placeholder="Ej. Instituto Culinario o Restaurante" class="w-full px-3 py-2 rounded-xl border border-gray-300 bg-white text-gray-900 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        </div>

                    </div>

                    <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-2.5 rounded-b-2xl">
                        <button type="button" onclick="closeModal()" class="px-3.5 py-2 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-200 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ========================================================================= --}}
    {{-- MODAL 2: EDITAR PORTADA --}}
    {{-- ========================================================================= --}}
    <div id="coverModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-cover-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-xs transition-opacity" onclick="closeCoverModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200">
                
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                            <i class="ri-image-edit-line"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900" id="modal-cover-title">
                                {{ $coverUrl ? 'Cambiar Foto de Portada' : 'Agregar Foto de Portada' }}
                            </h3>
                            <p class="text-[11px] text-gray-600 font-medium">Recomendado: 1920x600 px</p>
                        </div>
                    </div>
                    <button onclick="closeCoverModal()" class="w-7 h-7 rounded-lg text-gray-500 hover:text-gray-800 hover:bg-gray-100 flex items-center justify-center transition-colors">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>

                <form id="coverUpdateForm" method="POST" action="{{ route('profile.cover.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="p-5 space-y-3.5">
                        
                        <div class="relative w-full h-40 rounded-xl overflow-hidden bg-gray-50 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center group cursor-pointer" onclick="document.getElementById('coverUploadInput').click()">
                            <img id="modalCoverPreview" class="w-full h-full object-cover {{ $coverUrl ? '' : 'hidden' }}" src="{{ $coverUrl ?? '' }}" alt="Cover Preview">
                            
                            <div id="modalCoverPlaceholder" class="text-center p-3 {{ $coverUrl ? 'hidden' : '' }}">
                                <i class="ri-upload-cloud-line text-3xl text-emerald-600 mx-auto mb-1"></i>
                                <p class="text-sm font-bold text-gray-800">Seleccionar imagen de portada</p>
                                <p class="text-[10px] text-gray-600 mt-0.5 font-medium">JPG, PNG o WebP</p>
                            </div>

                            <label for="coverUploadInput" class="absolute bottom-2.5 right-2.5 px-2.5 py-1 rounded-lg bg-black/60 text-white text-[11px] font-bold backdrop-blur-xs cursor-pointer">
                                <i class="ri-folder-open-line mr-1"></i> Explorar
                            </label>
                            <input type="file" id="coverUploadInput" name="cover_image" accept="image/*" class="hidden">
                        </div>

                        @if($profile && $profile->cover_image)
                            <div class="flex justify-center pt-0.5">
                                <button type="button" onclick="confirmDeleteCover()" class="text-sm font-bold text-red-600 hover:text-red-700 inline-flex items-center gap-1">
                                    <i class="ri-delete-bin-line"></i> Eliminar portada actual
                                </button>
                            </div>
                        @endif

                    </div>

                    <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-2.5 rounded-b-2xl">
                        <button type="button" onclick="closeCoverModal()" class="px-3.5 py-2 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-200 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors">
                            Guardar Portada
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Forms for delete --}}
    @if($profile && $profile->profile)
        <form id="deleteProfileImageForm" method="POST" action="{{ route('profile.image.destroy') }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    @if($profile && $profile->cover_image)
        <form id="deleteCoverForm" method="POST" action="{{ route('profile.cover.destroy') }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    {{-- Toast helper for copy --}}
    <div id="copyTooltip" class="fixed bottom-6 right-6 z-50 bg-gray-900 text-white text-sm font-bold px-3.5 py-1.5 rounded-xl shadow-md transition-all duration-300 opacity-0 pointer-events-none transform translate-y-2">
        ¡Copiado al portapapeles!
    </div>

    {{-- JavaScript Controllers --}}
    <script>
        const editModal = document.getElementById('editModal');
        const coverModal = document.getElementById('coverModal');
        const toast = document.getElementById('toastNotification');

        function openModal() {
            if (editModal) {
                editModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal() {
            if (editModal) {
                editModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        function openCoverModal() {
            if (coverModal) {
                coverModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeCoverModal() {
            if (coverModal) {
                coverModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        function closeToast() {
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-10px)';
                setTimeout(() => toast.remove(), 300);
            }
        }

        if (toast) {
            setTimeout(() => {
                const bar = document.getElementById('toastProgress');
                if (bar) bar.style.width = '0%';
            }, 50);
            setTimeout(() => {
                closeToast();
            }, 4000);
        }

        function confirmDeleteProfileImage() {
            if (confirm('¿Estás seguro de que deseas eliminar tu foto de perfil?')) {
                const form = document.getElementById('deleteProfileImageForm');
                if (form) form.submit();
            }
        }

        function confirmDeleteCover() {
            if (confirm('¿Estás seguro de que deseas eliminar tu imagen de portada?')) {
                const form = document.getElementById('deleteCoverForm');
                if (form) form.submit();
            }
        }

        const imageUploadInput = document.getElementById('imageUploadInput');
        const modalProfilePreview = document.getElementById('modalProfilePreview');
        if (imageUploadInput && modalProfilePreview) {
            imageUploadInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        modalProfilePreview.src = evt.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        const coverUploadInput = document.getElementById('coverUploadInput');
        const modalCoverPreview = document.getElementById('modalCoverPreview');
        const modalCoverPlaceholder = document.getElementById('modalCoverPlaceholder');
        if (coverUploadInput && modalCoverPreview) {
            coverUploadInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        modalCoverPreview.src = evt.target.result;
                        modalCoverPreview.classList.remove('hidden');
                        if (modalCoverPlaceholder) {
                            modalCoverPlaceholder.classList.add('hidden');
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function copyToClipboard(text) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    const tooltip = document.getElementById('copyTooltip');
                    if (tooltip) {
                        tooltip.classList.remove('opacity-0', 'translate-y-2');
                        tooltip.classList.add('opacity-100', 'translate-y-0');
                        setTimeout(() => {
                            tooltip.classList.add('opacity-0', 'translate-y-2');
                            tooltip.classList.remove('opacity-100', 'translate-y-0');
                        }, 2000);
                    }
                });
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeCoverModal();
            }
        });

        @if($errors->any())
            openModal();
        @endif
    </script>

</x-app-layout>
