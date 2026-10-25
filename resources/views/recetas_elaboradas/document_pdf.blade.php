<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte PDF</title>
    <style>
        @page { margin: 12mm; }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
            background: #ffffff;
            font-size: 12px;
            line-height: 1.4;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 7px 6px;
            text-align: left;
            font-size: 11px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #15803d;
            color: #ffffff;
            font-weight: bold;
        }

        .header {
            background-color: #15803d;
            color: #ffffff;
            margin-bottom: 18px;
            width: 100%;
        }

        .header table {
            background-color: #15803d;
        }

        .header td {
            background-color: #15803d;
            border-bottom: 0;
            color: #ffffff;
            padding: 18px 20px;
        }

        .header h1, .header h3, .header p, .header span, .header div {
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #ffffff;
            line-height: 1.2;
            display: block;
        }

        .header-title {
            font-size: 22px;
            font-weight: bold;
            line-height: 1.2;
            color: #ffffff;
        }

        .header-description {
            margin-top: 7px;
            font-size: 11px;
            line-height: 1.4;
            color: #dcfce7;
        }

        .header-date-label {
            font-size: 10px;
            color: #dcfce7;
        }

        .header-date {
            margin-top: 4px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
        }

        .header p {
            margin-top: 6px;
            margin-bottom: 0;
            color: #dcfce7;
            line-height: 1.4;
            display: block;
        }

        .header-left, .header-right {
            width: 50%;
            display: table-cell;
            vertical-align: top;
        }

        .header-right {
            text-align: right;
        }

        .small {
            font-size: 10px;
            color: #dcfce7;
        }

        .card-box {
            margin-bottom: 18px;
        }

        .card {
            width: 24%;
            display: table-cell;
            padding: 10px 8px;
            border: 1px solid #d1d5db;
            text-align: center;
            background: #f9fafb;
            vertical-align: top;
        }

        .card:nth-child(1) { background: #f0fdf4; }
        .card:nth-child(2) { background: #f0fdf4; }
        .card:nth-child(3) { background: #ecfdf5; }
        .card:nth-child(4) { background: #dcfce7; }

        .label {
            font-size: 9px;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 6px;
            letter-spacing: 0.08em;
        }

        .section {
            border: 1px solid #e5e7eb;
            padding: 12px;
            margin-top: 14px;
            background: #ffffff;
        }

        .section h3 {
            border-left: 4px solid #16a34a;
            padding-left: 8px;
        }

        .section h3 {
            font-size: 14px;
            margin: 0 0 8px 0;
            color: #111827;
        }

        .right {
            text-align: right;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
        }

        .status.warning {
            background: #fef3c7;
            color: #92400e;
        }

        .status.danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    @php
        $utilidad = (float) $recetaElaborada->utilidad_real_porcentaje;
        $estado = $utilidad >= 35 ? 'Excelente' : ($utilidad >= 20 ? 'Aceptable' : 'Riesgo');
        $statusClass = $utilidad >= 35 ? '' : ($utilidad >= 20 ? 'warning' : 'danger');
    @endphp

    <div class="header">
        <table style="border-collapse: collapse; width: 100%;">
            <tr>
                <td class="header-left">
                    <div class="header-title">{{ $recetaElaborada->receta->nombre_receta ?? 'Reporte' }}</div>
                    <div class="header-description">{{ $recetaElaborada->receta->descripcion ?? 'Reporte de costo y rentabilidad' }}</div>
                </td>
                <td class="header-right" style="padding-left: 10px;">
                    <div class="header-date-label">Fecha</div>
                    <div class="header-date">{{ $recetaElaborada->created_at?->format('d/m/Y') ?? now()->format('d/m/Y') }}</div>
                    <div style="margin-top: 10px;">
                        <span class="status {{ $statusClass }}">{{ $estado }}</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="card-box" style="border-collapse: collapse; width: 100%; margin-bottom: 18px;">
        <tr>
            <td class="card">
                <div class="label">Costo total</div>
                <div class="strong">${{ number_format($recetaElaborada->costo_total, 2) }}</div>
            </td>
            <td class="card">
                <div class="label">Costo por porción</div>
                <div class="strong">${{ number_format($recetaElaborada->costo_por_porcion, 2) }}</div>
            </td>
            <td class="card">
                <div class="label">Precio por porción</div>
                <div class="strong">${{ number_format($recetaElaborada->precio_por_porcion, 2) }}</div>
            </td>
            <td class="card">
                <div class="label">Utilidad real</div>
                <div class="strong">{{ number_format($utilidad, 2) }}%</div>
            </td>
        </tr>
    </table>

    <div class="section">
        <h3>Resumen financiero</h3>
        <table>
            <tr>
                <th>Concepto</th>
                <th class="right">Valor</th>
            </tr>
            <tr>
                <td>Producción total</td>
                <td class="right">{{ $recetaElaborada->cantidad_porciones }}</td>
            </tr>
            <tr>
                <td>Costo neto</td>
                <td class="right">${{ number_format($recetaElaborada->costo_neto, 2) }}</td>
            </tr>
            <tr>
                <td>Mano de obra</td>
                <td class="right">${{ number_format($recetaElaborada->mano_obra, 2) }}</td>
            </tr>
            <tr>
                <td>Costos indirectos</td>
                <td class="right">${{ number_format($recetaElaborada->costos_indirectos, 2) }}</td>
            </tr>
            <tr>
                <td>Gastos de operación</td>
                <td class="right">${{ number_format($recetaElaborada->gastos_operacion, 2) }}</td>
            </tr>
            <tr>
                <td class="strong">Costo total</td>
                <td class="right strong">${{ number_format($recetaElaborada->costo_total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Detalle de ingredientes</h3>
        <table>
            <tr>
                <th>Ingrediente</th>
                <th class="right">Cantidad</th>
                <th class="right">Costo receta</th>
            </tr>
            @foreach($recetaElaborada->ingredientes as $detalle)
                <tr>
                    <td>{{ $detalle->ingrediente->nombre ?? 'Ingrediente' }}</td>
                    <td class="right">{{ number_format($detalle->cantidad_usada, 2) }} {{ $detalle->unidad_usada ?? '' }}</td>
                    <td class="right">${{ number_format($detalle->costo_receta, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="strong">Total ingredientes</td>
                <td colspan="2" class="right strong">${{ number_format($recetaElaborada->costo_neto, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h3>Evaluación financiera</h3>
        <table>
            <tr>
                <td>Utilidad deseada</td>
                <td class="right">{{ number_format((float) $recetaElaborada->utilidad_deseada, 2) }}%</td>
            </tr>
            <tr>
                <td>Utilidad real</td>
                <td class="right">{{ number_format((float) $recetaElaborada->utilidad_real_porcentaje, 2) }}%</td>
            </tr>
            <tr>
                <td>Costo objetivo</td>
                <td class="right">${{ number_format((float) $recetaElaborada->costo_objetivo, 2) }}</td>
            </tr>
            <tr>
                <td>Diferencia</td>
                <td class="right">${{ number_format((float) $recetaElaborada->diferencia_objetivo, 2) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
