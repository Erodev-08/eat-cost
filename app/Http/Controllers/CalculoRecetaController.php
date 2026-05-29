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
        'precio_venta' => 'required|numeric|min:0.01',
        'utilidad_deseada' => 'required|numeric|min:0|max:100',

        'ingredientes' => 'nullable|array',
        'ingredientes.*.merma_porcentaje' => 'nullable|numeric|min:0|max:99',
        'ingredientes.*.peso_util' => 'nullable|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request, $receta) {
            
            $receta->load('ingredientes');

            $costoNeto = 0;
            $detalles = [];

            foreach ($receta->ingredientes as $ingrediente) {
            $cantidadUsada = (float) $ingrediente->pivot->cantidad;
            $pesoBruto = (float) $ingrediente->presentacion_cantidad;
            $costoPresentacion = (float) $ingrediente->costo_presentacion;

            if ($cantidadUsada <= 0) {
                return back()->withErrors([
                    'ingredientes' => "El ingrediente {$ingrediente->nombre} no tiene cantidad usada válida."
                ])->withInput();
            }

            if ($pesoBruto <= 0) {
                return back()->withErrors([
                    'ingredientes' => "El ingrediente {$ingrediente->nombre} no tiene presentación válida."
                ])->withInput();
            }

            if ($costoPresentacion <= 0) {
                return back()->withErrors([
                    'ingredientes' => "El ingrediente {$ingrediente->nombre} no tiene costo de presentación válido."
                ])->withInput();
            }

            $datosIngrediente = $request->input("ingredientes.{$ingrediente->id_ingrediente}", []);

            $mermaPorcentaje = isset($datosIngrediente['merma_porcentaje'])
                ? (float) $datosIngrediente['merma_porcentaje']
                : 0;

            $pesoUtil = isset($datosIngrediente['peso_util']) && $datosIngrediente['peso_util'] !== ''
                ? (float) $datosIngrediente['peso_util']
                : null;

            if ($pesoUtil !== null && $pesoUtil > 0) {
                if ($pesoUtil > $pesoBruto) {
                    return back()->withErrors([
                        'ingredientes' => "El peso útil de {$ingrediente->nombre} no puede ser mayor que la presentación."
                    ])->withInput();
                }

                $rendimiento = $pesoUtil / $pesoBruto;
                $mermaPorcentaje = (1 - $rendimiento) * 100;
            } else {
                if ($mermaPorcentaje < 0 || $mermaPorcentaje >= 100) {
                    return back()->withErrors([
                        'ingredientes' => "La merma de {$ingrediente->nombre} debe estar entre 0 y 99%."
                    ])->withInput();
                }

                $rendimiento = 1 - ($mermaPorcentaje / 100);
                $pesoUtil = $pesoBruto * $rendimiento;
            }

            if ($rendimiento <= 0) {
                return back()->withErrors([
                    'ingredientes' => "El rendimiento de {$ingrediente->nombre} no puede ser 0."
                ])->withInput();
            }

            $costoReal = $costoPresentacion / $rendimiento;
            $costoUnitarioBase = $costoReal / $pesoBruto;
            $costoReceta = $cantidadUsada * $costoUnitarioBase;

            $costoNeto += $costoReceta;

            $detalles[] = [
                'id_ingrediente' => $ingrediente->id_ingrediente,
                'cantidad_usada' => $cantidadUsada,
                'unidad_usada' => $ingrediente->pivot->unidad_medida,
                'peso_bruto' => $pesoBruto,
                'peso_util' => $pesoUtil,
                'merma_porcentaje' => $mermaPorcentaje,
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
            ->route('recetas.elaboradas.show', $recetaElaborada->id_receta_elaborada)
            ->with('status', 'success-calculo');
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

        if ($receta->ingredientes->isEmpty()) {
            return back()->withErrors([
                'ingredientes' => 'La receta no tiene ingredientes registrados.'
            ]);
        }

        return view('recetas.calcular', compact('receta'));
    }

    public function index()
    {
        $recetasElaboradas = RecetaCalc::with('receta')
            ->latest('id_receta_elaborada')
            ->paginate(6);

        return view('recetas_elaboradas.index', compact('recetasElaboradas'));
    }
}
