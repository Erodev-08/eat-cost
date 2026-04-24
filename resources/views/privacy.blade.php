<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Privacidad - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f0e7] text-gray-900">
        <main class="mx-auto max-w-3xl px-6 py-10 sm:py-14">
            <div class="rounded-3xl border border-orange-100 bg-white p-6 shadow-[0_20px_60px_rgba(158,112,68,0.10)] sm:p-8">
                <h1 class="text-2xl font-bold sm:text-3xl">Política de privacidad</h1>
                <p class="mt-3 text-sm text-gray-600">Última actualización: 23 de abril de 2026</p>

                <section class="mt-6 space-y-4 text-sm leading-7 text-gray-700">
                    <p>
                        La información proporcionada por los usuarios se utiliza únicamente para el funcionamiento del sitio
                        y para mejorar la experiencia dentro de la plataforma.
                    </p>
                    <p>
                        No se hará ningún uso mal intencionado de los datos de los usuarios. Este sitio no promueve ni vende
                        datos personales de los usuarios.
                    </p>
                    <p>
                        Se reconoce y respeta el derecho a la privacidad de los datos personales, conforme a las leyes
                        aplicables en materia de protección de datos.
                    </p>
                    <p>
                        Los usuarios pueden solicitar información sobre sus datos y su tratamiento a través de los canales
                        de contacto del sitio.
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
