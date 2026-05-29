@extends('layouts.plantilla')

@section('title', 'CulinFinance')

@section('content')

  @if (Session::has('success'))
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
                                  @if(Session::get('success') == 'success-user')
                                      Sesion inicianda
                                  @elseif(Session::get('success') == 'success-logout')
                                      Sesion finalizada
                                  @else
                                      {{ Session::get('success') }}
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
                                  $status = Session::get('success');
                                  $message = match($status) {
                                      'success-user' => 'Iniciante sesion corectamente.',
                                      'success-logout' => 'Sesion cerranda correctamente.',
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

      <div class="container mx-auto px-4 mt-16">

        {{-- Hero Section --}}
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-bold text-blue-900 mb-4">Bienvenido a Eat Cost</h1>
            <p class="text-xl text-gray-600">Tu plataforma de gestión financiera</p>
        </div>
        
        <hr class="mb-8">
        
      </div>

@endsection
