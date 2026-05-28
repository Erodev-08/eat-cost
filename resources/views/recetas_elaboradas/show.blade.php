@extends('layouts.plantilla')

@section('title', 'Reporte de receta')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">
        Reporte técnico de receta
    </h1>

    <p><strong>Receta:</strong> {{ $recetaElaborada->receta->nombre_receta }}</p>
    <p><strong>Costo total:</strong> ${{ number_format($recetaElaborada->costo_total, 2) }}</p>
    <p><strong>Utilidad real:</strong> ${{ number_format($recetaElaborada->utilidad_real, 2) }}</p>
    <p><strong>Utilidad %:</strong> {{ number_format($recetaElaborada->utilidad_real_porcentaje, 2) }}%</p>
    <p><strong>Interpretación:</strong> {{ $recetaElaborada->interpretacion }}</p>
</div>
@endsection