<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,500,600;instrument-serif:400,500,700&display=swap" rel="stylesheet" />

		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="font-sans antialiased bg-[#f5ede4] text-gray-900">
		<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
			<section class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-[#e8864b] via-[#efad73] to-[#88a07a] text-white px-8 py-10 sm:px-12 lg:px-14 flex-col justify-between">
				<div class="absolute inset-0 opacity-20 pointer-events-none">
					<div class="absolute -left-10 top-10 h-40 w-40 rounded-full bg-white/20 blur-3xl"></div>
					<div class="absolute right-0 top-1/3 h-56 w-56 rounded-full bg-white/10 blur-3xl"></div>
					<div class="absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-black/10 blur-3xl"></div>
				</div>

				<div class="relative z-10">
					<div class="mb-10 flex items-center gap-3">
						<div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-sm ring-1 ring-white/20">
							<svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
								<path d="M7 20h10a2 2 0 0 0 2-2v-4H5v4a2 2 0 0 0 2 2Z" />
								<path d="M7 14c0-2 1.5-3.5 3.5-3.5h3c2 0 3.5 1.5 3.5 3.5" />
								<path d="M8 10.5c0-2 1.2-3.7 3-4.5" />
								<path d="M16 10.5c0-2-1.2-3.7-3-4.5" />
							</svg>
						</div>
						<div>
							<div class="text-2xl font-bold tracking-tight">CulinFinance</div>
						</div>
					</div>

					<h1 class="max-w-xl font-serif text-5xl leading-[1.05] font-bold tracking-tight sm:text-6xl">
						Domina tus finanzas, cocina tu éxito
					</h1>
					<p class="mt-6 max-w-lg text-base leading-7 text-white/90 sm:text-lg">
						La plataforma educativa diseñada para estudiantes de artes culinarias que quieren fortalecer sus competencias financieras.
					</p>

					<div class="mt-12 grid gap-4 sm:grid-cols-2">
						<article class="rounded-2xl border border-white/20 bg-white/12 p-5 backdrop-blur-sm shadow-[0_20px_60px_rgba(0,0,0,0.08)]">
							<div class="mb-4 text-2xl">↗</div>
							<h2 class="text-lg font-semibold">Aprende finanzas</h2>
							<p class="mt-2 text-sm leading-6 text-white/85">Conceptos aplicados al mundo culinario</p>
						</article>
						<article class="rounded-2xl border border-white/20 bg-white/12 p-5 backdrop-blur-sm shadow-[0_20px_60px_rgba(0,0,0,0.08)]">
							<div class="mb-4 text-2xl">⌘</div>
							<h2 class="text-lg font-semibold">Herramientas prácticas</h2>
							<p class="mt-2 text-sm leading-6 text-white/85">Calcula costos, márgenes y presupuestos</p>
						</article>
					</div>
				</div>

				<div class="relative z-10 mt-10 flex justify-end">
					<div class="flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-sm">
						<span class="h-2 w-2 rounded-full bg-white"></span>
						Control simple, resultados claros
					</div>
				</div>
			</section>

			<section class="flex items-center justify-center px-6 py-10 sm:px-10 lg:px-16 bg-[#f7f0e7]">
				<div class="w-full max-w-[30rem] rounded-[2rem] border border-white/70 bg-white/90 p-6 sm:p-8 shadow-[0_30px_80px_rgba(158,112,68,0.12)] backdrop-blur">
					{{ $slot }}
				</div>
			</section>
		</div>
	</body>
</html>
