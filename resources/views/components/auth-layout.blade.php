<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Eat-Cost | Costeo Culinario') }}</title>

		<!-- Fonts & Icons -->
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
		<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />

		<!-- Vite Assets -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-full flex flex-col">
		
		<div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 flex-1">
			
			{{-- Left Brand Banner (Hidden on Mobile, Visible on Desktop) --}}
			<section class="hidden lg:flex lg:col-span-5 xl:col-span-5 relative overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-800 text-white px-8 py-12 xl:px-12 flex-col justify-between shadow-2xl">
				
				{{-- Decorative background glow circles --}}
				<div class="absolute inset-0 opacity-20 pointer-events-none">
					<div class="absolute -left-12 -top-12 h-64 w-64 rounded-full bg-white/30 blur-3xl"></div>
					<div class="absolute right-0 top-1/2 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
					<div class="absolute bottom-0 left-1/3 h-80 w-80 -translate-x-1/2 rounded-full bg-teal-900/40 blur-3xl"></div>
				</div>

				{{-- Brand Header --}}
				<div class="relative z-10 space-y-8">
					
					{{-- Logo --}}
					<a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
						<div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-md ring-1 ring-white/30 shadow-md group-hover:scale-105 transition-transform">
							<i class="ri-restaurant-line text-2xl text-white"></i>
						</div>
						<div>
							<div class="text-2xl font-black tracking-tight flex items-center">
								<span class="text-white font-black">Eat</span>
								<span class="text-emerald-300 mx-0.5 font-light">•</span>
								<span class="text-emerald-200 font-semibold">Cost</span>
							</div>
							<p class="text-[10px] uppercase font-bold tracking-widest text-emerald-100/90">Costeo Gastronómico</p>
						</div>
					</a>

					{{-- Main Pitch --}}
					<div class="space-y-3 pt-2">
						<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-emerald-50 text-xs font-bold backdrop-blur-xs">
							<span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-pulse"></span>
							<span>Ingeniería de Menú & Mermas</span>
						</div>
						<h1 class="text-3xl xl:text-4xl font-black leading-tight tracking-tight text-white">
							Domina tus costos, protege el margen de tu cocina.
						</h1>
						<p class="text-xs xl:text-sm leading-relaxed text-emerald-50 font-medium">
							Calcula mermas reales, costos unitarios por porción y precios de venta sugeridos en segundos para chefs, reposteros y restaurantes.
						</p>
					</div>

					{{-- Feature Highlights --}}
					<div class="grid gap-3 pt-2">
						<div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-md flex items-start gap-3.5 shadow-sm">
							<div class="w-9 h-9 rounded-xl bg-white/20 text-white flex items-center justify-center text-lg shrink-0">
								<i class="ri-scales-3-line"></i>
							</div>
							<div>
								<h3 class="text-xs font-bold text-white">Cálculo de Mermas Reales</h3>
								<p class="text-[11px] text-emerald-100 mt-0.5 leading-normal">
									Aplica el factor de merma por limpieza y cocción a cada gramo de materia prima.
								</p>
							</div>
						</div>

						<div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-md flex items-start gap-3.5 shadow-sm">
							<div class="w-9 h-9 rounded-xl bg-white/20 text-white flex items-center justify-center text-lg shrink-0">
								<i class="ri-pie-chart-2-line"></i>
							</div>
							<div>
								<h3 class="text-xs font-bold text-white">Márgenes y Precio Sugerido</h3>
								<p class="text-[11px] text-emerald-100 mt-0.5 leading-normal">
									Visualiza el costo por porción y asegura tu ganancia con precios objetivos.
								</p>
							</div>
						</div>
					</div>

				</div>

				{{-- Bottom Trust Bar --}}
				<div class="relative z-10 pt-6 flex items-center justify-between border-t border-white/15 text-xs text-emerald-100 font-medium">
					<span>© {{ date('Y') }} Eat-Cost</span>
					<span class="inline-flex items-center gap-1.5">
						<i class="ri-shield-check-fill text-emerald-300"></i> Seguro & Confiable
					</span>
				</div>

			</section>

			{{-- Right Form Container --}}
			<section class="col-span-1 lg:col-span-7 xl:col-span-7 flex flex-col items-center justify-center px-4 py-10 sm:px-8 lg:px-12 xl:px-16 bg-gray-50/70">
				
				{{-- Mobile Brand Logo Header --}}
				<div class="lg:hidden mb-6 text-center">
					<a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
						<div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-md">
							<i class="ri-restaurant-line text-xl"></i>
						</div>
						<div class="text-left">
							<div class="text-xl font-black tracking-tight text-gray-900">
								<span class="text-emerald-700">Eat</span><span class="text-gray-300 mx-0.5 font-light">•</span><span class="text-emerald-500">Cost</span>
							</div>
							<p class="text-[9px] uppercase font-bold tracking-wider text-gray-500">Costeo Gastronómico</p>
						</div>
					</a>
				</div>

				{{-- Form Card --}}
				<div class="w-full max-w-md bg-white rounded-3xl border border-gray-200/90 p-6 sm:p-8 shadow-xl shadow-gray-200/50">
					{{ $slot }}
				</div>

				{{-- Back to Home link --}}
				<div class="mt-6 text-center">
					<a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-emerald-700 transition-colors">
						<i class="ri-arrow-left-line"></i>
						Volver a la página principal
					</a>
				</div>

			</section>

		</div>

	</body>
</html>
