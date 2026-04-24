<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Términos del sitio - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f0e7] text-gray-900">
        <main class="mx-auto max-w-3xl px-6 py-10 sm:py-14">
            <div class="rounded-3xl border border-orange-100 bg-white p-6 shadow-[0_20px_60px_rgba(158,112,68,0.10)] sm:p-8">
                <h1 class="text-2xl font-bold sm:text-3xl">Términos del sitio</h1>
                <p class="mt-3 text-sm text-gray-600">Última actualización: 23 de abril de 2026</p>

                <section class="mt-6 space-y-4 text-sm leading-7 text-gray-700">
                    <p>
                        Al usar este sitio, aceptas un uso responsable de la plataforma y de la información compartida en ella.
                        Nuestro objetivo es educativo y de apoyo para estudiantes y usuarios del entorno culinario y financiero.
                    </p>
                    <p>
                        No se hará ningún uso mal intencionado de los datos de los usuarios. El sitio no promueve ni vende
                        datos personales de los usuarios.
                    </p>
                    <p>
                        Este sitio respeta el derecho a la privacidad de los datos personales y actúa conforme a las leyes
                        aplicables de protección de datos y privacidad.
                    </p>
                    <p>
                        Si no estás de acuerdo con estos términos, debes abstenerte de usar la plataforma.
                    </p>
                </section>

                <div class="mt-8">
                    <a href="{{ route('register') }}" class="inline-flex items-center rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600">
                        Volver al registro
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
