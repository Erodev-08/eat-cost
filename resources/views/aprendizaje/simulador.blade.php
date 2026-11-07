@extends('layouts.plantilla')

@section('title', 'Simulador Financiero Integrador - Eat-Cost')

@section('content')

{{-- ENCABEZADO ESTÁNDAR DEL SITIO --}}
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="mb-4 sm:mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                    Simulador Financiero
                    <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                </h1>
                <p class="text-gray-500 mt-2 font-medium">
                    Experimenta en tiempo real con mermas, costos fijos, insumos y volumen para proyectar la rentabilidad neta de tus recetas.
                </p>
            </div>

            <div class="mb-4 sm:mb-8 flex items-center gap-3">
                <button type="button" onclick="restablecerValores()" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all mt-3">
                    <i class="ri-refresh-line text-lg"></i>
                    <span>Restablecer valores</span>
                </button>
                <a href="{{ route('aprendizaje.index') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl py-2.5 px-4 shadow-sm shadow-emerald-600/20 transition-all hover:-translate-y-0.5 mt-3">
                    <i class="ri-arrow-left-line text-lg"></i>
                    <span>Volver a la Academia</span>
                </a>
            </div>
        </div>
        <hr class="mb-8 border-gray-200 border-dashed">
    </div>
</div>

{{-- CONTENEDOR PRINCIPAL --}}
<div class="px-5 py-3 md:px-5 md:py-4">
    <div class="mx-auto max-w-7xl">

        {{-- GRID DE 2 COLUMNAS (5 cols controles / 7 cols resultados) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- Panel de Controles / Sliders --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <i class="ri-equalizer-line text-emerald-600"></i>
                            <span>Variables de Operación</span>
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">Ajusta los controles deslizantes para simular diferentes escenarios.</p>
                    </div>

                    {{-- 1. Merma --}}
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-gray-700">Porcentaje de Merma (%):</span>
                            <span class="text-emerald-700 font-bold text-sm" id="lbl-merma">20%</span>
                        </div>
                        <input type="range" id="sl-merma" min="0" max="60" step="1" value="20" oninput="simular()" class="w-full accent-emerald-600">
                        <div class="flex justify-between text-[11px] text-gray-400 mt-1">
                            <span>0% (Sin desperdicio)</span>
                            <span>60% (Alta merma)</span>
                        </div>
                    </div>

                    {{-- 2. Costo Base Insumo --}}
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-gray-700">Costo de Insumos Bruto por Plato:</span>
                            <span class="text-emerald-700 font-bold text-sm" id="lbl-costo-base">$45.00 MXN</span>
                        </div>
                        <input type="range" id="sl-costo-base" min="10" max="250" step="5" value="45" oninput="simular()" class="w-full accent-emerald-600">
                        <div class="flex justify-between text-[11px] text-gray-400 mt-1">
                            <span>$10</span>
                            <span>$250</span>
                        </div>
                    </div>

                    {{-- 3. Costos Fijos --}}
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-gray-700">Costos Fijos Mensuales (Renta/Sueldos):</span>
                            <span class="text-emerald-700 font-bold text-sm" id="lbl-costos-fijos">$35,000 MXN</span>
                        </div>
                        <input type="range" id="sl-costos-fijos" min="5000" max="150000" step="2500" value="35000" oninput="simular()" class="w-full accent-emerald-600">
                        <div class="flex justify-between text-[11px] text-gray-400 mt-1">
                            <span>$5,000</span>
                            <span>$150,000</span>
                        </div>
                    </div>

                    {{-- 4. Precio Venta --}}
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-gray-700">Precio de Venta por Plato:</span>
                            <span class="text-emerald-700 font-bold text-sm" id="lbl-precio">$160.00 MXN</span>
                        </div>
                        <input type="range" id="sl-precio" min="50" max="600" step="5" value="160" oninput="simular()" class="w-full accent-emerald-600">
                        <div class="flex justify-between text-[11px] text-gray-400 mt-1">
                            <span>$50</span>
                            <span>$600</span>
                        </div>
                    </div>

                    {{-- 5. Volumen Ventas --}}
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-gray-700">Platos Vendidos al Mes:</span>
                            <span class="text-emerald-700 font-bold text-sm" id="lbl-volumen">650 platos</span>
                        </div>
                        <input type="range" id="sl-volumen" min="50" max="3000" step="25" value="650" oninput="simular()" class="w-full accent-emerald-600">
                        <div class="flex justify-between text-[11px] text-gray-400 mt-1">
                            <span>50 platos</span>
                            <span>3,000 platos</span>
                        </div>
                    </div>

                </div>

                {{-- Diagnóstico Automático --}}
                <div id="box-diagnostico" class="p-5 rounded-2xl border text-xs leading-relaxed bg-white shadow-sm border-gray-100">
                    <!-- Dinámico -->
                </div>
            </div>

            {{-- Panel de Resultados --}}
            <div class="lg:col-span-7 space-y-6">
                
                {{-- Tarjetas KPI --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Costo Absorción</p>
                        <p class="text-xl font-bold text-gray-900 mt-1" id="kpi-costo-absorbido">$56.25</p>
                        <span class="text-[10px] text-gray-400">porción útil</span>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Margen Bruto</p>
                        <p class="text-xl font-bold text-gray-900 mt-1" id="kpi-margen-bruto">64.8%</p>
                        <span class="text-[10px] text-gray-400">sobre venta</span>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Punto Equilibrio</p>
                        <p class="text-xl font-bold text-gray-900 mt-1" id="kpi-pe-unidades">338 platos</p>
                        <span class="text-[10px] text-gray-400">para no perder</span>
                    </div>

                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-emerald-100 bg-emerald-50/50">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-700">Utilidad Neta</p>
                        <p class="text-xl font-extrabold text-emerald-700 mt-1" id="kpi-utilidad-neta">$32,437</p>
                        <span class="text-[10px] text-emerald-600">estimado libre</span>
                    </div>
                </div>

                {{-- Barra de distribución de ingresos --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-700 flex items-center gap-1.5">
                            <i class="ri-pie-chart-line text-emerald-600"></i> Desglose de cada $100 facturados
                        </h3>
                        <span class="text-xs text-gray-500 font-semibold" id="resumen-ventas-totales">Ventas: $104,000 MXN</span>
                    </div>

                    <div class="h-5 w-full rounded-full overflow-hidden flex bg-gray-100 p-0.5 mb-4 border border-gray-200">
                        <div id="bar-cv" class="bg-red-400 h-full rounded-l-full transition-all duration-300" style="width: 35%"></div>
                        <div id="bar-cf" class="bg-amber-400 h-full transition-all duration-300" style="width: 33%"></div>
                        <div id="bar-utilidad" class="bg-emerald-500 h-full rounded-r-full transition-all duration-300" style="width: 32%"></div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between text-xs gap-3 font-medium">
                        <span class="flex items-center gap-1.5 text-gray-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span>
                            <span id="txt-pct-cv">35.2% Costos Variables</span>
                        </span>
                        <span class="flex items-center gap-1.5 text-gray-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span>
                            <span id="txt-pct-cf">33.7% Costos Fijos</span>
                        </span>
                        <span class="flex items-center gap-1.5 text-emerald-700 font-bold">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span>
                            <span id="txt-pct-utilidad">31.1% Utilidad Neta</span>
                        </span>
                    </div>
                </div>

                {{-- Estado de Resultados Mensual --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-700 mb-3 flex items-center gap-1.5">
                        <i class="ri-file-list-3-line text-emerald-600"></i> Estado de Resultados Proyectado
                    </h3>

                    <div class="flex items-center justify-between text-sm py-2 border-b border-gray-100 font-semibold">
                        <span class="text-gray-700">Ventas Totales Proyectadas:</span>
                        <span class="text-gray-900 font-bold font-mono" id="tb-ventas">$104,000.00</span>
                    </div>

                    <div class="flex items-center justify-between text-sm py-2 border-b border-gray-100">
                        <span class="text-gray-500">(-) Costo Variable Total (Insumos con Merma):</span>
                        <span class="text-red-600 font-mono" id="tb-cv">-$36,562.50</span>
                    </div>

                    <div class="flex items-center justify-between text-sm py-2 border-b border-gray-100 font-bold">
                        <span class="text-emerald-700">(=) Margen de Contribución Total:</span>
                        <span class="text-emerald-700 font-mono" id="tb-contribucion">$67,437.50</span>
                    </div>

                    <div class="flex items-center justify-between text-sm py-2 border-b border-gray-100">
                        <span class="text-gray-500">(-) Costos Fijos Operativos (Renta, Nómina):</span>
                        <span class="text-amber-600 font-mono" id="tb-cf">-$35,000.00</span>
                    </div>

                    <div class="flex items-center justify-between text-base py-3 font-bold bg-emerald-50/60 px-4 rounded-xl border border-emerald-100">
                        <span id="tb-label-utilidad" class="text-emerald-900">(=) Utilidad Neta Mensual:</span>
                        <span class="font-mono text-xl text-emerald-700" id="tb-utilidad">$32,437.50</span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@push('scripts')
<script>
    function simular() {
        let merma = parseFloat(document.getElementById('sl-merma').value);
        let costoBase = parseFloat(document.getElementById('sl-costo-base').value);
        let costosFijos = parseFloat(document.getElementById('sl-costos-fijos').value);
        let precio = parseFloat(document.getElementById('sl-precio').value);
        let volumen = parseFloat(document.getElementById('sl-volumen').value);

        // Labels
        document.getElementById('lbl-merma').innerText = merma + '%';
        document.getElementById('lbl-costo-base').innerText = '$' + costoBase.toFixed(2) + ' MXN';
        document.getElementById('lbl-costos-fijos').innerText = '$' + costosFijos.toLocaleString('es-MX', {minimumFractionDigits: 0}) + ' MXN';
        document.getElementById('lbl-precio').innerText = '$' + precio.toFixed(2) + ' MXN';
        document.getElementById('lbl-volumen').innerText = volumen + ' platos';

        // Cálculos
        let rendimiento = (100 - merma) / 100;
        let costoVariableUnitario = rendimiento > 0 ? (costoBase / rendimiento) : costoBase * 3;
        let mcu = precio - costoVariableUnitario;
        let margenBrutoPct = precio > 0 ? ((precio - costoVariableUnitario) / precio) * 100 : 0;
        let peUnidades = mcu > 0 ? Math.ceil(costosFijos / mcu) : 999999;

        let ventasTotales = precio * volumen;
        let costosVariablesTotales = costoVariableUnitario * volumen;
        let utilidadNeta = ventasTotales - costosVariablesTotales - costosFijos;

        let pctCV = ventasTotales > 0 ? Math.max(0, (costosVariablesTotales / ventasTotales) * 100) : 0;
        let pctCF = ventasTotales > 0 ? Math.max(0, (costosFijos / ventasTotales) * 100) : 0;
        let pctUtilidad = ventasTotales > 0 ? ((utilidadNeta / ventasTotales) * 100) : 0;

        // KPIs
        document.getElementById('kpi-costo-absorbido').innerText = '$' + costoVariableUnitario.toFixed(2);
        document.getElementById('kpi-margen-bruto').innerText = margenBrutoPct.toFixed(1) + '%';
        document.getElementById('kpi-pe-unidades').innerText = (peUnidades < 999999 ? peUnidades : 'Inviable') + ' platos';

        let kpiUtilidad = document.getElementById('kpi-utilidad-neta');
        kpiUtilidad.innerText = (utilidadNeta >= 0 ? '$' : '-$') + Math.abs(utilidadNeta).toLocaleString('es-MX', {maximumFractionDigits: 0});
        kpiUtilidad.className = 'text-xl font-extrabold mt-1 ' + (utilidadNeta >= 0 ? 'text-emerald-700' : 'text-red-600');

        // Barra
        let barCV = Math.min(100, pctCV);
        let barCF = Math.min(100 - barCV, pctCF);
        let barUtil = Math.max(0, 100 - barCV - barCF);

        document.getElementById('bar-cv').style.width = barCV + '%';
        document.getElementById('bar-cf').style.width = barCF + '%';
        document.getElementById('bar-utilidad').style.width = barUtil + '%';

        document.getElementById('txt-pct-cv').innerText = pctCV.toFixed(1) + '% Costos Variables';
        document.getElementById('txt-pct-cf').innerText = pctCF.toFixed(1) + '% Costos Fijos';
        document.getElementById('txt-pct-utilidad').innerText = pctUtilidad.toFixed(1) + '% Margen Neto';

        // Tabla
        document.getElementById('resumen-ventas-totales').innerText = 'Ventas: $' + ventasTotales.toLocaleString('es-MX', {minimumFractionDigits: 2});
        document.getElementById('tb-ventas').innerText = '$' + ventasTotales.toLocaleString('es-MX', {minimumFractionDigits: 2});
        document.getElementById('tb-cv').innerText = '-$' + costosVariablesTotales.toLocaleString('es-MX', {minimumFractionDigits: 2});
        document.getElementById('tb-contribucion').innerText = '$' + (ventasTotales - costosVariablesTotales).toLocaleString('es-MX', {minimumFractionDigits: 2});
        document.getElementById('tb-cf').innerText = '-$' + costosFijos.toLocaleString('es-MX', {minimumFractionDigits: 2});

        let tbUtilidad = document.getElementById('tb-utilidad');
        let tbLabel = document.getElementById('tb-label-utilidad');
        if (utilidadNeta >= 0) {
            tbUtilidad.innerText = '$' + utilidadNeta.toLocaleString('es-MX', {minimumFractionDigits: 2});
            tbUtilidad.className = 'font-mono text-xl text-emerald-700';
            tbLabel.innerText = '(=) Utilidad Neta Mensual:';
        } else {
            tbUtilidad.innerText = '-$' + Math.abs(utilidadNeta).toLocaleString('es-MX', {minimumFractionDigits: 2});
            tbUtilidad.className = 'font-mono text-xl text-red-600';
            tbLabel.innerText = '(=) Pérdida Neta Mensual:';
        }

        // Diagnóstico
        let boxDiag = document.getElementById('box-diagnostico');
        if (utilidadNeta < 0) {
            boxDiag.className = 'p-5 rounded-2xl border border-red-200 bg-red-50 text-red-800 text-xs leading-relaxed';
            boxDiag.innerHTML = `
                <strong class="text-red-700 block mb-1 text-sm font-bold"><i class="ri-error-warning-line"></i> Alerta Financiera: Operación con Pérdidas</strong>
                Estás vendiendo ${volumen} platos pero necesitas vender <strong>${peUnidades} platos</strong> solo para no perder dinero.
                Se sugiere reducir merma o ajustar el precio de venta.
            `;
        } else if (pctUtilidad < 15) {
            boxDiag.className = 'p-5 rounded-2xl border border-amber-200 bg-amber-50 text-amber-900 text-xs leading-relaxed';
            boxDiag.innerHTML = `
                <strong class="text-amber-800 block mb-1 text-sm font-bold"><i class="ri-alert-line"></i> Margen Ajustado (${pctUtilidad.toFixed(1)}%)</strong>
                El restaurante cubre sus gastos pero cuenta con poco margen de maniobra ante eventualidades.
            `;
        } else {
            boxDiag.className = 'p-5 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-900 text-xs leading-relaxed';
            boxDiag.innerHTML = `
                <strong class="text-emerald-800 block mb-1 text-sm font-bold"><i class="ri-checkbox-circle-line"></i> Operación Rentable y Saludable</strong>
                Margen neto proyectado de <strong>${pctUtilidad.toFixed(1)}%</strong>, superando el punto de equilibrio mensual por ${(volumen - peUnidades)} platos.
            `;
        }
    }

    function restablecerValores() {
        document.getElementById('sl-merma').value = 20;
        document.getElementById('sl-costo-base').value = 45;
        document.getElementById('sl-costos-fijos').value = 35000;
        document.getElementById('sl-precio').value = 160;
        document.getElementById('sl-volumen').value = 650;
        simular();
    }

    document.addEventListener('DOMContentLoaded', () => {
        simular();
    });
</script>
@endpush
@endsection
