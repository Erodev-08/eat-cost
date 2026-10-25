<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de receta</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
            margin: 0;
            padding: 0;
            background: #ffffff;
            font-size: 15px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 12px 14px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #15803d;
            color: #ffffff;
            font-weight: bold;
            font-size: 15px;
        }

        .header {
            background-color: #15803d;
            color: #ffffff;
            padding: 24px;
            height: 72px;
        }

        .header strong {
            color: #ffffff;
        }

        .subtitle {
            margin: 6px 0 0 0;
            font-size: 12px;
            color: #dcfce7;
        }

        .section-title {
            font-size: 17px;
            font-weight: bold;
            background: #dcfce7;
            color: #14532d;
            padding: 12px 14px;
        }

        .totals td {
            background: #f8fafc;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: bold;
        }

        .recipe-title {
            font-size: 26px;
            font-weight: bold;
        }

        .recipe-description {
            margin-top: 8px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    @php
        $utilidad = (float) ($recetaElaborada->utilidad_real_porcentaje ?? 0);
        $estado = $utilidad >= 35 ? 'Excelente' : ($utilidad >= 20 ? 'Aceptable' : 'Riesgo');
    @endphp

    <table>
        <tr>
            <td class="header" colspan="4">
                <div class="recipe-title">{{ $recetaElaborada->receta->nombre_receta ?? 'Reporte de receta' }}</div>
                <div class="recipe-description">{{ $recetaElaborada->receta->descripcion ?? 'Reporte de costo y rentabilidad' }}</div>
            </td>
        </tr>
        <tr>
            <td style="background: #f0fdf4; font-weight: bold;">Fecha</td>
            <td>{{ $recetaElaborada->created_at?->format('d/m/Y') ?? now()->format('d/m/Y') }}</td>
            <td style="background: #f0fdf4; font-weight: bold;">Producción</td>
            <td>{{ $recetaElaborada->cantidad_porciones }}</td>
        </tr>
        <tr>
            <td style="background: #dcfce7; font-weight: bold;">Estado</td>
            <td><span class="badge">{{ $estado }}</span></td>
            <td style="background: #dcfce7; font-weight: bold;">Reporte</td>
            <td>Costos y rentabilidad</td>
        </tr>
        <tr>
            <td style="background: #f0fdf4; font-weight: bold;">Costo total</td>
            <td>${{ number_format($recetaElaborada->costo_total, 2) }}</td>
            <td style="background: #f0fdf4; font-weight: bold;">Costo por porción</td>
            <td>${{ number_format($recetaElaborada->costo_por_porcion, 2) }}</td>
        </tr>
        <tr>
            <td style="background: #ecfdf5; font-weight: bold;">Precio por porción</td>
            <td>${{ number_format($recetaElaborada->precio_por_porcion, 2) }}</td>
            <td style="background: #ecfdf5; font-weight: bold;">Utilidad real</td>
            <td><span class="badge">{{ number_format($utilidad, 2) }}%</span></td>
        </tr>
    </table>

    <table style="margin-top: 16px;">
        <tr>
            <td class="section-title" colspan="2">Resumen financiero</td>
        </tr>
        <tr>
            <th>Concepto</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Producción total</td>
            <td>{{ $recetaElaborada->cantidad_porciones }}</td>
        </tr>
        <tr>
            <td>Costo neto</td>
            <td>${{ number_format($recetaElaborada->costo_neto, 2) }}</td>
        </tr>
        <tr>
            <td>Mano de obra</td>
            <td>${{ number_format($recetaElaborada->mano_obra, 2) }}</td>
        </tr>
        <tr>
            <td>Costos indirectos</td>
            <td>${{ number_format($recetaElaborada->costos_indirectos, 2) }}</td>
        </tr>
        <tr>
            <td>Gastos de operación</td>
            <td>${{ number_format($recetaElaborada->gastos_operacion, 2) }}</td>
        </tr>
        <tr class="totals">
            <td>Costo total</td>
            <td>${{ number_format($recetaElaborada->costo_total, 2) }}</td>
        </tr>
    </table>

    <table style="margin-top: 16px;">
        <tr>
            <td class="section-title" colspan="3">Detalle de ingredientes</td>
        </tr>
        <tr>
            <th>Ingrediente</th>
            <th>Cantidad</th>
            <th>Costo receta</th>
        </tr>
        @foreach($recetaElaborada->ingredientes as $detalle)
            <tr>
                <td>{{ $detalle->ingrediente->nombre ?? 'Ingrediente' }}</td>
                <td>{{ number_format($detalle->cantidad_usada, 2) }} {{ $detalle->unidad_usada ?? '' }}</td>
                <td>${{ number_format($detalle->costo_receta, 2) }}</td>
            </tr>
        @endforeach
        <tr class="totals">
            <td>Total ingredientes</td>
            <td colspan="2">${{ number_format($recetaElaborada->costo_neto, 2) }}</td>
        </tr>
    </table>

    <table style="margin-top: 16px;">
        <tr>
            <td class="section-title" colspan="2">Evaluación financiera</td>
        </tr>
        <tr>
            <th>Concepto</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Utilidad deseada</td>
            <td>{{ number_format((float) $recetaElaborada->utilidad_deseada, 2) }}%</td>
        </tr>
        <tr>
            <td>Utilidad real</td>
            <td>{{ number_format($utilidad, 2) }}%</td>
        </tr>
        <tr>
            <td>Costo objetivo</td>
            <td>${{ number_format((float) $recetaElaborada->costo_objetivo, 2) }}</td>
        </tr>
        <tr class="totals">
            <td>Diferencia</td>
            <td>${{ number_format((float) $recetaElaborada->diferencia_objetivo, 2) }}</td>
        </tr>
    </table>
</body>
</html>
