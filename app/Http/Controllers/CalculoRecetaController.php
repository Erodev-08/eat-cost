<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\RecetaCalc;
use App\Models\RecetaCalcIngrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CalculoRecetaController extends Controller
{
    public function store(Request $request, Receta $receta)
    {
        $request->validate([
            'mano_obra' => 'required|numeric|min:0',
            'costos_indirectos' => 'required|numeric|min:0',
            'gastos_operacion' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'utilidad_deseada' => 'required|numeric|min:0|max:100',
        ]);

        return DB::transaction(function () use ($request, $receta) {

            $receta->load('ingredientes');

            $costoNeto = 0;
            $detalles = [];

            foreach ($receta->ingredientes as $ingrediente) {
                $cantidadUsada = $ingrediente->pivot->cantidad;

                $rendimiento = 1;
                $costoReal = $ingrediente->costo_presentacion / $rendimiento;
                $costoUnitarioBase = $costoReal / $ingrediente->presentacion_cantidad;
                $costoReceta = $cantidadUsada * $costoUnitarioBase;

                $costoNeto += $costoReceta;

                $detalles[] = [
                    'id_ingrediente' => $ingrediente->id_ingrediente,
                    'cantidad_usada' => $cantidadUsada,
                    'unidad_usada' => $ingrediente->pivot->unidad_medida,
                    'peso_bruto' => $ingrediente->presentacion_cantidad,
                    'peso_util' => $ingrediente->presentacion_cantidad,
                    'merma_porcentaje' => 0,
                    'rendimiento' => $rendimiento,
                    'costo_real' => $costoReal,
                    'costo_unitario_base' => $costoUnitarioBase,
                    'costo_receta' => $costoReceta,
                ];
            }

            $manoObra = $request->mano_obra;
            $costosIndirectos = $request->costos_indirectos;
            $gastosOperacion = $request->gastos_operacion;
            $precioVenta = $request->precio_venta;
            $utilidadDeseada = $request->utilidad_deseada / 100;

            $costoProduccion = $costoNeto + $manoObra + $costosIndirectos;
            $costoTotal = $costoProduccion + $gastosOperacion;
            $precioSinIva = $precioVenta / 1.16;
            $utilidadReal = $precioSinIva - $costoTotal;
            $utilidadRealPorcentaje = $precioSinIva > 0
                ? ($utilidadReal / $precioSinIva) * 100
                : 0;

            $costoObjetivo = $precioSinIva * (1 - $utilidadDeseada);
            $diferenciaObjetivo = $costoTotal - $costoObjetivo;

            $interpretacion = $diferenciaObjetivo > 0
                ? 'El costo real supera el costo objetivo. Se recomienda reducir mermas, buscar mejores precios de ingredientes u optimizar mano de obra.'
                : 'La receta cumple con la utilidad deseada. El costo está dentro del objetivo.';

            $recetaElaborada = RecetaCalc::create([
                'id_receta' => $receta->id_receta,
                'id_usuario' => auth()->id(),
                'mano_obra' => $manoObra,
                'costos_indirectos' => $costosIndirectos,
                'gastos_operacion' => $gastosOperacion,
                'precio_venta' => $precioVenta,
                'utilidad_deseada' => $request->utilidad_deseada,
                'costo_neto' => $costoNeto,
                'costo_produccion' => $costoProduccion,
                'costo_total' => $costoTotal,
                'precio_sin_iva' => $precioSinIva,
                'utilidad_real' => $utilidadReal,
                'utilidad_real_porcentaje' => $utilidadRealPorcentaje,
                'costo_objetivo' => $costoObjetivo,
                'diferencia_objetivo' => $diferenciaObjetivo,
                'interpretacion' => $interpretacion,
            ]);

            foreach ($detalles as $detalle) {
                $detalle['id_receta_elaborada'] = $recetaElaborada->id_receta_elaborada;
                RecetaCalcIngrediente::create($detalle);
            }

            return redirect()
                ->route('recetas.elaboradas.show', $recetaElaborada)
                ->with('status', 'Cálculo generado correctamente');
        });
    }

    public function show($id)
    {
        $recetaElaborada = RecetaCalc::with([
            'receta',
            'ingredientes.ingrediente'
        ])->findOrFail($id);

        return view('recetas_elaboradas.show', compact('recetaElaborada'));
    }

    public function create(Receta $receta)
    {
        $receta->load('ingredientes');

        return view('recetas.calcular', compact('receta'));
    }
}
