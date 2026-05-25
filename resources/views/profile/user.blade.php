<x-app-layout>

    {{-- start: Main --}}
    <div class="py-2 px-6 bg-orange-500 flex item-center shadow-md shadow-xl/20">
        <button type="button" class="text-lg text-gray-100">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-3">
                <a href="#" class="text-gray-100 hover:text-gray-200 font-medium">Profile User</a>
            </li>
        </ul>
    </div>

    {{-- Alert Overlay Flotante - Reemplaza el código actual de la alerta --}}
    @if (Session::has('status'))
        {{-- Fondo oscuro semitransparente --}}
        <div id="alertOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300">
            {{-- Contenedor de la alerta --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-100">
                <div class="flex flex-col">
                    {{-- Header con ícono y botón de cerrar --}}
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.333 6a3.667 3.667 0 0 1 3.667 3.667v8.666a3.667 3.667 0 0 1 -3.667 3.667h-8.666a3.667 3.667 0 0 1 -3.667 -3.667v-8.666a3.667 3.667 0 0 1 3.667 -3.667zm-3.333 -4c1.094 0 1.828 .533 2.374 1.514a1 1 0 1 1 -1.748 .972c-.221 -.398 -.342 -.486 -.626 -.486h-10c-.548 0 -1 .452 -1 1v9.998c0 .32 .154 .618 .407 .805l.1 .065a1 1 0 1 1 -.99 1.738a3 3 0 0 1 -1.517 -2.606v-10c0 -1.652 1.348 -3 3 -3zm1.293 9.293l-3.293 3.292l-1.293 -1.292a1 1 0 0 0 -1.414 1.414l2 2a1 1 0 0 0 1.414 0l4 -4a1 1 0 0 0 -1.414 -1.414" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white capitalize">
                                @if(Session::get('status') == 'profile-updated')
                                    Perfil actualizado
                                @elseif(Session::get('status') == 'cover-updated')
                                    Portada actualizada
                                @elseif(Session::get('status') == 'image-deleted')
                                    Imagen eliminada
                                @elseif(Session::get('status') == 'cover-deleted')
                                    Portada eliminada
                                @else
                                    {{ Session::get('status') }}
                                @endif
                            </h3>
                        </div>
                        <button onclick="closeAlert()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"></path>
                            </svg>
                        </button>
                    </div>
                    
                    {{-- Body con el mensaje --}}
                    <div class="p-4">
                        <p class="text-gray-600 dark:text-gray-300 text-center">
                            @php
                                $status = Session::get('status');
                                $message = match($status) {
                                    'profile-updated' => 'Tu perfil ha sido actualizado exitosamente.',
                                    'cover-updated' => 'Tu imagen de portada ha sido actualizada.',
                                    'image-deleted' => 'Tu foto de perfil ha sido eliminada.',
                                    'cover-deleted' => 'Tu imagen de portada ha sido eliminada.',
                                    default => $status
                                };
                            @endphp
                            {{ $message }}
                        </p>
                    </div>
                    
                    {{-- Footer con botón --}}
                    <div class="flex justify-center p-4 border-t dark:border-gray-700">
                        <button onclick="closeAlert()" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors font-medium">
                            Entendido
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script para manejar el cierre automático y manual --}}
        <script>
            // Función para cerrar la alerta
            function closeAlert() {
                const alertOverlay = document.getElementById('alertOverlay');
                if (alertOverlay) {
                    alertOverlay.style.opacity = '0';
                    setTimeout(() => {
                        alertOverlay.remove();
                    }, 300);
                }
            }

            // Cerrar al hacer clic fuera del contenido
            document.addEventListener('click', function(e) {
                const alertOverlay = document.getElementById('alertOverlay');
                if (alertOverlay && e.target === alertOverlay) {
                    closeAlert();
                }
            });
        </script>
    @endif

    {{-- Cover Image Section - Se extiende a todo el ancho --}}
    <div class="relative w-full px-4 py-4">
        <!-- Cover Image Container -->
        <div class="relative h-70 md:h-90 lg:h-96 w-full overflow-hidden rounded-md {{ $profile && $profile->cover_image ? '' : 'bg-gray-300' }}">
            @if($profile && $profile->cover_image)
                <img id="coverImage" class="w-full h-full object-cover" src="{{ Storage::url($profile->cover_image) }}" alt="Cover">
                <!-- Overlay para mejor contraste -->
                <div class="absolute inset-0 bg-gray-500 bg-opacity-30"></div>
            @else
                <!-- Fondo gris cuando no hay imagen de portada -->
                {{-- bg-gradient-to-br from-gray-700 to-gray-800 --}}
                <div id="coverPlaceholder" class="w-full h-full bg-gray-300 flex items-center justify-center">
                    <div class="text-center">
                        <i class="ri-image-line text-6xl text-gray-500 mb-2"></i>
                        <p class="text-gray-400 text-sm">Sin imagen de portada</p>
                    </div>
                </div>
            @endif
            
            <!-- Botones de acción sobre la portada -->
            <div class="absolute bottom-4 right-4 flex gap-2 z-10">
                <!-- Botón para editar/agregar portada -->
                <button id="editCoverBtn" class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white px-3 py-1 rounded-lg text-sm transition-all">
                    <i class="ri-camera-line mr-1"></i> 
                    {{ $profile && $profile->cover_image ? 'Editar Portada' : 'Agregar Portada' }}
                </button>
            </div>
        </div>

    </div>

    @php
        $profileImage = $profile && $profile->profile 
            ? Storage::url($profile->profile) 
            : 'https://ui-avatars.com/api/?background=3b82f6&color=fff&name=' . urlencode($user->name);
    @endphp

    <div class="py-3">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                {{-- <img id="profileImageOld" class="w-12 h-12 rounded-full object-cover" src="{{ $profileImage }}" alt="Profile"> --}}
                                <img id="profileImageOld" class="w-12 h-12 rounded-full object-cover" src="{{ $profile && $profile->profile ? Storage::url($profile->profile) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff&name=' . urlencode($user->name) }}" alt="Profile">
                            </div>
                            <div>
                                <h2 id="displayNameOld" class="text-xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                                <p id="displayEmailOld" class="text-sm text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div>
                            <button id="openModalBtn" class="px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
                                <i class="ri-file-edit-line"></i>
                                Edit User
                            </button>
                            <button id="openViewModalBtn" type="button" class="px-4 py-3 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition-colors inline-flex items-center gap-2">
                                <i class="ri-eye-line"></i>
                                View Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View User -->
    <div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-3 border-b dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">View User Profile</h3>
                <button id="closeViewModalBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="py-4">
                <!-- Profile Image -->
                <div class="flex justify-center mb-4">
                    <div class="relative">
                        @php
                            $profileImage = $profile && $profile->profile 
                                ? Storage::url($profile->profile) 
                                : 'https://ui-avatars.com/api/?background=3b82f6&color=fff&name=' . urlencode($user->name);
                        @endphp
                        <img class="w-32 h-32 rounded-full object-cover border-4 border-blue-500" src="{{ $profileImage }}" alt="Profile">
                    </div>
                </div>

                <!-- User Details -->
                <div class="space-y-3">
                    <div class="border-b dark:border-gray-700 pb-2">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nombre completo</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                    </div>

                    <div class="border-b dark:border-gray-700 pb-2">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Correo electrónico</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->email }}</p>
                    </div>

                    <div class="border-b dark:border-gray-700 pb-2">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Miembro desde</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'No disponible' }}</p>
                    </div>

                    <div class="dark:border-gray-700 pb-2">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Institucion</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->institution }}</p>
                    </div>

                    {{-- @if($profile && $profile->cover_image)
                    <div class="pb-2">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Imagen de portada</label>
                        <img src="{{ Storage::url($profile->cover_image) }}" alt="Cover" class="w-full h-32 object-cover rounded-lg">
                    </div>
                    @endif --}}
                </div>
            </div>

            <!-- Modal footer -->
            <div class="flex justify-end space-x-3 pt-3 border-t dark:border-gray-700">
                <button type="button" id="cancelViewBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Cerrar
                </button>
                <button type="button" onclick="window.location.href='{{ route('profile.edit') }}'" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                    Editar Perfil
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para editar perfil -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-3 border-b dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit User Profile</h3>
                <button id="closeModalBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="profileUpdateForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <!-- Modal body -->
                <div class="py-4">
                    <!-- Profile Image Upload -->
                    <div class="mb-4 flex flex-col items-center">
                        <div class="relative mb-3">
                            <img id="modalProfileImage" class="w-24 h-24 rounded-full object-cover border-4 border-blue-500" src="{{ $profileImage }}" alt="Profile">
                            <label for="imageUpload" class="absolute bottom-0 right-0 bg-blue-600 rounded-full p-1 cursor-pointer hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </label>
                            <input type="file" id="imageUpload" name="profile_image" accept="image/*" class="hidden">
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Haz clic en el ícono de la cámara para cambiar la foto</p>
                        @if($profile && $profile->profile)
                            <button type="button" id="deleteImageBtn" class="mt-2 text-sm text-red-600 hover:text-red-700 dark:text-red-400">Eliminar imagen actual</button>
                        @endif
                    </div>

                    <!-- Name Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre</label>
                        <input type="text" id="userName" name="name" value="{{ old('name', $user->nombre) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" id="userEmail" name="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex justify-end space-x-3 pt-3 border-t dark:border-gray-700">
                    <button type="button" id="cancelBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar portada -->
    <div id="coverModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center pb-3 border-b dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $profile && $profile->cover_image ? 'Editar Portada' : 'Agregar Portada' }}
                </h3>
                <button id="closeCoverModalBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="coverUpdateForm" method="POST" action="{{ route('profile.cover.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="py-4">
                    <div class="mb-4 flex flex-col items-center">
                        <div class="relative mb-3 w-full">
                            @if($profile && $profile->cover_image)
                                <img id="modalCoverImage" class="w-full h-48 object-cover rounded-lg" src="{{ Storage::url($profile->cover_image) }}" alt="Cover">
                            @else
                                <div id="modalCoverPlaceholder" class="w-full h-48 bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="ri-image-line text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-gray-400 text-sm">Sin imagen de portada</p>
                                    </div>
                                </div>
                            @endif
                            <label for="coverUpload" class="absolute bottom-2 right-2 bg-blue-600 rounded-full p-2 cursor-pointer hover:bg-blue-700 transition-colors z-10">
                                <i class="ri-camera-line text-white"></i>
                            </label>
                            <input type="file" id="coverUpload" name="cover_image" accept="image/*" class="hidden">
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Selecciona una imagen para tu portada (recomendado: 1920x400)</p>
                        
                        <!-- Botón para eliminar portada dentro del modal -->
                        @if($profile && $profile->cover_image)
                        <button type="button" id="deleteCoverBtn" class="mt-2 text-sm text-red-600 hover:text-red-700 dark:text-red-400 flex items-center gap-1">
                            <i class="ri-delete-bin-line"></i>
                            Eliminar imagen de portada actual
                        </button>
                        @endif
                    </div>
                </div>
                <div class="flex justify-end space-x-3 pt-3 border-t dark:border-gray-700">
                    <button type="button" id="cancelCoverBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulario oculto para eliminar imagen -->
    @if($profile && $profile->profile)
    <form id="deleteImageForm" method="POST" action="{{ route('profile.image.destroy') }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endif

    <script>
      // Get elements
      const modal = document.getElementById('editModal');
      const coverModal = document.getElementById('coverModal');
      const openModalBtn = document.getElementById('openModalBtn');
      const openModalBtnFromCover = document.getElementById('openModalBtnFromCover');
      const editCoverBtn = document.getElementById('editCoverBtn');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const closeCoverModalBtn = document.getElementById('closeCoverModalBtn');
      const cancelBtn = document.getElementById('cancelBtn');
      const cancelCoverBtn = document.getElementById('cancelCoverBtn');
      const imageUpload = document.getElementById('imageUpload');
      const coverUpload = document.getElementById('coverUpload');
      const deleteImageBtn = document.getElementById('deleteImageBtn');
      const modalProfileImage = document.getElementById('modalProfileImage');
      const modalCoverImage = document.getElementById('modalCoverImage');
      const profileImage = document.getElementById('profileImage');
      const coverImage = document.getElementById('coverImage');
      const profileUpdateForm = document.getElementById('profileUpdateForm');
      const coverUpdateForm = document.getElementById('coverUpdateForm');
      const deleteImageForm = document.getElementById('deleteImageForm');
      const deleteCoverBtn = document.getElementById('deleteCoverBtn');
      const viewModal = document.getElementById('viewModal');
      const openViewModalBtn = document.getElementById('openViewModalBtn');
      const closeViewModalBtn = document.getElementById('closeViewModalBtn');
      const cancelViewBtn = document.getElementById('cancelViewBtn');
      const toggleViewBtn = document.getElementById('toggleViewBtn');
      const viewCollapse = document.getElementById('viewCollapse');
      const toggleIcon = document.getElementById('toggleIcon');

      // Abrir modal de vista
        if (openViewModalBtn) {
            openViewModalBtn.onclick = function() {
                if (viewModal) {
                    viewModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }
        }

        // Función para cerrar modal de vista
        function closeViewModal() {
            if (viewModal) {
                viewModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Cerrar modal de vista con botones
        if (closeViewModalBtn) closeViewModalBtn.onclick = closeViewModal;
        if (cancelViewBtn) cancelViewBtn.onclick = closeViewModal;

        // Cerrar modal de vista al hacer clic fuera
        if (viewModal) {
            viewModal.onclick = function(e) {
                if (e.target === viewModal) {
                    closeViewModal();
                }
            }
        }

        // Mostrar vista previa de la imagen de perfil seleccionada
        if (imageUpload) {
            imageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        modalProfileImage.src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        if (coverUpload) {
            coverUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        // Ocultar placeholder y mostrar imagen
                        const modalCoverImage = document.getElementById('modalCoverImage');
                        const modalCoverPlaceholder = document.getElementById('modalCoverPlaceholder');
                        
                        if (modalCoverImage) {
                            modalCoverImage.src = event.target.result;
                            modalCoverImage.classList.remove('hidden');
                        }
                        if (modalCoverPlaceholder) {
                            modalCoverPlaceholder.classList.add('hidden');
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Delete cover image
        if (deleteCoverBtn) {
            deleteCoverBtn.onclick = function() {
                if (confirm('¿Estás seguro de que deseas eliminar tu portada?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("profile.cover.destroy") }}';
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        }

        // Open profile modal
        function openModal() {
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        if (openModalBtn) openModalBtn.onclick = openModal;
        if (openModalBtnFromCover) openModalBtnFromCover.onclick = openModal;

        // Open cover modal
        if (editCoverBtn) {
            editCoverBtn.onclick = function() {
                if (coverModal) {
                    coverModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }
        }

        // Close modal functions
        function closeModal() {
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                if (imageUpload) imageUpload.value = '';
            }
        }

        function closeCoverModal() {
            if (coverModal) {
                coverModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                if (coverUpload) coverUpload.value = '';
            }
        }

        if (closeModalBtn) closeModalBtn.onclick = closeModal;
        if (cancelBtn) cancelBtn.onclick = closeModal;
        if (closeCoverModalBtn) closeCoverModalBtn.onclick = closeCoverModal;
        if (cancelCoverBtn) cancelCoverBtn.onclick = closeCoverModal;

        // Close modals when clicking outside
        if (modal) {
            modal.onclick = function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            }
        }

        if (coverModal) {
            coverModal.onclick = function(e) {
                if (e.target === coverModal) {
                    closeCoverModal();
                }
            }
        }

        // Delete image
        if (deleteImageBtn) {
            deleteImageBtn.onclick = function() {
                if (confirm('¿Estás seguro de que deseas eliminar tu foto de perfil?')) {
                    deleteImageForm.submit();
                }
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (modal && !modal.classList.contains('hidden')) {
                    closeModal();
                }
                if (coverModal && !coverModal.classList.contains('hidden')) {
                    closeCoverModal();
                }
                if (viewModal && !viewModal.classList.contains('hidden')) {
                    closeViewModal();
                }
            }
        });

        @if($errors->any())
            if (modal) modal.classList.remove('hidden');
        @endif
    </script>

</x-app-layout>
