<?php

namespace Database\Seeders;

use App\Models\Ingrediente;
use App\Models\Receta;
use App\Models\RecetaCalc;
use App\Models\RecetaCalcIngrediente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecetaRentableSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $usuario = User::firstOrFail();

            $receta = Receta::updateOrCreate(
                ['slug' => 'avena-con-platano'],
                [
                    'nombre_receta' => 'Avena con plátano',
                    'descripcion' => 'Avena cremosa con plátano, ideal para un desayuno sencillo y rentable.',
                    'procedimiento' => 'Cocer la avena con la leche, agregar el plátano en rodajas y servir caliente.',
                    'cantidad_porciones' => 2,
                    'porciones' => 2,
                    'tipo_porcion' => 'porciones',
                    'id_usuario' => $usuario->id_usuario,
                    'fecha_creacion' => now()->toDateString(),
                    'imagen' => null,
                ]
            );

            $ingredientes = [
                [
                    'nombre' => 'Avena',
                    'unidad_medida' => 'gr',
                    'presentacion_cantidad' => 500,
                    'presentacion_unidad' => 'gr',
                    'costo_presentacion' => 35,
                    'cantidad' => 100,
                ],
                [
                    'nombre' => 'Platano',
                    'unidad_medida' => 'gr',
                    'presentacion_cantidad' => 1000,
                    'presentacion_unidad' => 'gr',
                    'costo_presentacion' => 30,
                    'cantidad' => 200,
                ],
                [
                    'nombre' => 'Leche',
                    'unidad_medida' => 'ml',
                    'presentacion_cantidad' => 1000,
                    'presentacion_unidad' => 'ml',
                    'costo_presentacion' => 28,
                    'cantidad' => 400,
                ],
            ];

            $attachData = [];
            $detalleIngredientes = [];
            $costoNeto = 0;

            foreach ($ingredientes as $datos) {
                $ingrediente = Ingrediente::updateOrCreate(
                    ['nombre' => $datos['nombre']],
                    [
                        'unidad_medida' => $datos['unidad_medida'],
                        'presentacion_cantidad' => $datos['presentacion_cantidad'],
                        'presentacion_unidad' => $datos['presentacion_unidad'],
                        'costo_presentacion' => $datos['costo_presentacion'],
                    ]
                );

                $costoReceta = $datos['cantidad'] * ($datos['costo_presentacion'] / $datos['presentacion_cantidad']);
                $costoNeto += $costoReceta;

                $attachData[$ingrediente->id_ingrediente] = [
                    'cantidad' => $datos['cantidad'],
                    'unidad_medida' => $datos['unidad_medida'],
                    'merma_aplicada' => 0,
                ];

                $detalleIngredientes[] = [
                    'ingrediente' => $ingrediente,
                    'cantidad' => $datos['cantidad'],
                    'costo' => $costoReceta,
                    'presentacion' => $datos['presentacion_cantidad'],
                ];
            }

            $receta->ingredientes()->sync($attachData);

            $manoObra = 5;
            $costosIndirectos = 2;
            $gastosOperacion = 3;
            $cantidadPorciones = 2;
            $precioPorPorcion = 45;
            $costoProduccion = $costoNeto + $manoObra + $costosIndirectos;
            $costoTotal = $costoProduccion + $gastosOperacion;
            $costoPorPorcion = $costoTotal / $cantidadPorciones;
            $precioSinIva = $precioPorPorcion / 1.16;
            $gananciaPorPorcion = $precioSinIva - $costoPorPorcion;
            $gananciaTotal = $gananciaPorPorcion * $cantidadPorciones;
            $utilidadRealPorcentaje = ($gananciaPorPorcion / $precioSinIva) * 100;
            $utilidadDeseada = 40;
            $costoObjetivo = $precioSinIva * (1 - ($utilidadDeseada / 100));

            $elaboracion = RecetaCalc::updateOrCreate(
                ['id_receta' => $receta->id_receta, 'id_usuario' => $usuario->id_usuario],
                [
                    'cantidad_porciones' => $cantidadPorciones,
                    'mano_obra' => $manoObra,
                    'costos_indirectos' => $costosIndirectos,
                    'gastos_operacion' => $gastosOperacion,
                    'precio_por_porcion' => $precioPorPorcion,
                    'precio_venta' => $precioPorPorcion * $cantidadPorciones,
                    'utilidad_deseada' => $utilidadDeseada,
                    'costo_neto' => $costoNeto,
                    'costo_produccion' => $costoProduccion,
                    'costo_total' => $costoTotal,
                    'costo_por_porcion' => $costoPorPorcion,
                    'precio_sin_iva' => $precioSinIva,
                    'utilidad_real' => $gananciaTotal,
                    'ganancia_por_porcion' => $gananciaPorPorcion,
                    'ganancia_total' => $gananciaTotal,
                    'utilidad_real_porcentaje' => $utilidadRealPorcentaje,
                    'costo_objetivo' => $costoObjetivo,
                    'diferencia_objetivo' => $costoPorPorcion - $costoObjetivo,
                    'interpretacion' => 'La receta genera una rentabilidad positiva y cumple la utilidad deseada.',
                ]
            );

            $elaboracion->ingredientes()->delete();
            foreach ($detalleIngredientes as $detalle) {
                RecetaCalcIngrediente::create([
                    'id_receta_elaborada' => $elaboracion->id_receta_elaborada,
                    'id_ingrediente' => $detalle['ingrediente']->id_ingrediente,
                    'cantidad_usada' => $detalle['cantidad'],
                    'unidad_usada' => $detalle['ingrediente']->unidad_medida,
                    'peso_bruto' => $detalle['presentacion'],
                    'peso_util' => $detalle['presentacion'],
                    'merma_porcentaje' => 0,
                    'rendimiento' => 1,
                    'costo_real' => $detalle['ingrediente']->costo_presentacion,
                    'costo_unitario_base' => $detalle['ingrediente']->costo_presentacion / $detalle['presentacion'],
                    'costo_receta' => $detalle['costo'],
                ]);
            }
        });
    }
}
