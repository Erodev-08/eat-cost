<?php

namespace Database\Seeders;

use App\Models\Ingrediente;
use App\Models\Receta;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'nombre' => 'Demo User',
                'email' => 'demo@example.com',
                'contrasena' => Hash::make('password'),
                'institution' => 'CulinFinance',
                'rol' => 'estudiante',
            ]);
        }

        $recetas = [
            [
                'nombre_receta' => 'Ensalada fresca',
                'descripcion' => 'Ensalada ligera con vegetales variados.',
                'procedimiento' => 'Lavar, cortar y mezclar los vegetales. Servir frio.',
                'porciones' => 2,
            ],
            [
                'nombre_receta' => 'Pasta cremosa',
                'descripcion' => 'Pasta con salsa cremosa y hierbas.',
                'procedimiento' => 'Cocer la pasta, preparar la salsa y mezclar.',
                'porciones' => 4,
            ],
            [
                'nombre_receta' => 'Tacos de pollo',
                'descripcion' => 'Tacos con pollo sazonado y vegetales.',
                'procedimiento' => 'Cocinar el pollo, calentar tortillas y armar.',
                'porciones' => 3,
            ],
            [
                'nombre_receta' => 'Sopa de tomate',
                'descripcion' => 'Sopa suave de tomate con especias.',
                'procedimiento' => 'Cocer tomates, licuar y hervir con especias.',
                'porciones' => 4,
            ],
            [
                'nombre_receta' => 'Brownie clasico',
                'descripcion' => 'Brownie humedo de chocolate.',
                'procedimiento' => 'Mezclar ingredientes, hornear y enfriar.',
                'porciones' => 6,
            ],
        ];

        $ingredientesPorReceta = [
            'Ensalada fresca' => [
                ['nombre' => 'Lechuga', 'unidad_medida' => 'g', 'costo_unitario' => 0.02, 'cantidad' => 150],
                ['nombre' => 'Tomate', 'unidad_medida' => 'g', 'costo_unitario' => 0.03, 'cantidad' => 120],
                ['nombre' => 'Pepino', 'unidad_medida' => 'g', 'costo_unitario' => 0.02, 'cantidad' => 100],
                ['nombre' => 'Aceite de oliva', 'unidad_medida' => 'ml', 'costo_unitario' => 0.05, 'cantidad' => 15],
                ['nombre' => 'Sal', 'unidad_medida' => 'g', 'costo_unitario' => 0.01, 'cantidad' => 2],
            ],
            'Pasta cremosa' => [
                ['nombre' => 'Pasta', 'unidad_medida' => 'g', 'costo_unitario' => 0.02, 'cantidad' => 300],
                ['nombre' => 'Crema', 'unidad_medida' => 'ml', 'costo_unitario' => 0.04, 'cantidad' => 200],
                ['nombre' => 'Ajo', 'unidad_medida' => 'g', 'costo_unitario' => 0.06, 'cantidad' => 10],
                ['nombre' => 'Queso parmesano', 'unidad_medida' => 'g', 'costo_unitario' => 0.08, 'cantidad' => 40],
                ['nombre' => 'Mantequilla', 'unidad_medida' => 'g', 'costo_unitario' => 0.05, 'cantidad' => 25],
            ],
            'Tacos de pollo' => [
                ['nombre' => 'Pollo', 'unidad_medida' => 'g', 'costo_unitario' => 0.06, 'cantidad' => 350],
                ['nombre' => 'Tortillas', 'unidad_medida' => 'u', 'costo_unitario' => 0.15, 'cantidad' => 8],
                ['nombre' => 'Cebolla', 'unidad_medida' => 'g', 'costo_unitario' => 0.02, 'cantidad' => 80],
                ['nombre' => 'Cilantro', 'unidad_medida' => 'g', 'costo_unitario' => 0.03, 'cantidad' => 20],
                ['nombre' => 'Limon', 'unidad_medida' => 'u', 'costo_unitario' => 0.2, 'cantidad' => 1],
            ],
            'Sopa de tomate' => [
                ['nombre' => 'Tomate', 'unidad_medida' => 'g', 'costo_unitario' => 0.03, 'cantidad' => 400],
                ['nombre' => 'Cebolla', 'unidad_medida' => 'g', 'costo_unitario' => 0.02, 'cantidad' => 100],
                ['nombre' => 'Ajo', 'unidad_medida' => 'g', 'costo_unitario' => 0.06, 'cantidad' => 8],
                ['nombre' => 'Caldo de verduras', 'unidad_medida' => 'ml', 'costo_unitario' => 0.01, 'cantidad' => 500],
                ['nombre' => 'Aceite', 'unidad_medida' => 'ml', 'costo_unitario' => 0.04, 'cantidad' => 10],
            ],
            'Brownie clasico' => [
                ['nombre' => 'Harina', 'unidad_medida' => 'g', 'costo_unitario' => 0.01, 'cantidad' => 180],
                ['nombre' => 'Cacao', 'unidad_medida' => 'g', 'costo_unitario' => 0.07, 'cantidad' => 60],
                ['nombre' => 'Azucar', 'unidad_medida' => 'g', 'costo_unitario' => 0.01, 'cantidad' => 150],
                ['nombre' => 'Mantequilla', 'unidad_medida' => 'g', 'costo_unitario' => 0.05, 'cantidad' => 120],
                ['nombre' => 'Huevo', 'unidad_medida' => 'u', 'costo_unitario' => 0.2, 'cantidad' => 2],
            ],
        ];

        foreach ($recetas as $recetaData) {
            $receta = Receta::firstOrCreate(
                ['slug' => Str::slug($recetaData['nombre_receta'], '-')],
                [
                    'nombre_receta' => $recetaData['nombre_receta'],
                    'descripcion' => $recetaData['descripcion'],
                    'procedimiento' => $recetaData['procedimiento'],
                    'porciones' => $recetaData['porciones'],
                    'id_usuario' => $user->id_usuario,
                    'fecha_creacion' => now()->toDateString(),
                    'imagen' => null,
                ]
            );

            $ingredientes = $ingredientesPorReceta[$recetaData['nombre_receta']] ?? [];
            if (!$ingredientes) {
                continue;
            }

            $attachData = [];
            foreach ($ingredientes as $ing) {
                $ingrediente = Ingrediente::firstOrCreate(
                    ['nombre' => $ing['nombre']],
                    [
                        'unidad_medida' => $ing['unidad_medida'] ?? null,
                        'costo_unitario' => $ing['costo_unitario'] ?? null,
                    ]
                );

                $attachData[$ingrediente->id_ingrediente] = [
                    'cantidad' => $ing['cantidad'] ?? null,
                    'merma_aplicada' => $ing['merma_aplicada'] ?? 0,
                ];
            }

            $receta->ingredientes()->syncWithoutDetaching($attachData);
        }
    }
}
