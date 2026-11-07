<?php

namespace Database\Seeders;

use App\Models\ConceptoFinanciero;
use Illuminate\Database\Seeder;

class ConceptosFinancierosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecciones = [
            // ================= MÓDULO 1 =================
            [
                'orden' => 1,
                'slug' => 'clasificacion-de-costos',
                'titulo' => '1. Clasificación de Costos',
                'icono' => 'ri-folders-line',
                'badge_categoria' => 'Fundamentos',
                'descripcion' => 'Aprende a diferenciar qué gastos son fijos y cuáles varían con cada platillo servido.',
                'formula' => 'Costo Total = Costos Fijos + Costos Variables',
                'ejemplo' => 'Pagas $15,000 de renta vendas 10 o 500 platos (Fijo). La carne y verduras suben con cada comensal (Variable).',
                'contenido_detallado' => [
                    'introduccion' => 'En cocina, los costos se dividen en dos grandes grupos según su comportamiento respecto a las ventas.',
                    'puntos_clave' => [
                        [
                            'titulo' => 'Costos Fijos (CF)',
                            'texto' => 'Se pagan siempre igual: alquiler del local, sueldos fijos, seguros y licencias.'
                        ],
                        [
                            'titulo' => 'Costos Variables (CV)',
                            'texto' => 'Aumentan con cada plato servido: carnes, verduras, lácteos y empaques desechables.'
                        ]
                    ],
                    'regla_de_oro' => '¿Se paga aunque el restaurante no abra hoy? Si es SÍ, es Costo Fijo. Si gastas solo al cocinar, es Costo Variable.',
                    'modal_alert' => [
                        'titulo' => 'Consejo Rápido de Gestión',
                        'tipo' => 'tip',
                        'mensaje' => 'Mantener los Costos Fijos lo más bajos posible reduce el riesgo del negocio y te permite ser rentable con menos comensales diarios.'
                    ]
                ],
                'ejercicio_interactivo' => [
                    'tipo' => 'clasificador',
                    'instruccion' => 'Clasifica cada concepto en Costo Fijo o Costo Variable:',
                    'items' => [
                        ['id' => 1, 'nombre' => 'Renta del local', 'tipo' => 'fijo'],
                        ['id' => 2, 'nombre' => 'Pechuga de pollo', 'tipo' => 'variable'],
                        ['id' => 3, 'nombre' => 'Sueldo de cocinero base', 'tipo' => 'fijo'],
                        ['id' => 4, 'nombre' => 'Cajas de hamburguesa para llevar', 'tipo' => 'variable'],
                    ]
                ],
                'quiz' => [
                    'banco_preguntas' => [
                        [
                            'id' => 1,
                            'pregunta' => 'Si este mes vendes la mitad de platos que el mes pasado, ¿qué costo permanece exactamente igual?',
                            'opciones' => [
                                'La compra de carne y vegetales',
                                'El alquiler mensual pactado del local',
                                'Los envases desechables utilizados',
                                'El aceite consumido para freír'
                            ],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'El alquiler es fijo; no disminuye si las ventas bajan.'
                        ],
                        [
                            'id' => 2,
                            'pregunta' => '¿Por qué la materia prima directa se cataloga como Costo Variable?',
                            'opciones' => [
                                'Porque sube o baja proporcionalmente al número de platos preparados',
                                'Porque su precio cambia solo en navidad',
                                'Porque es opcional comprarla',
                                'Porque se paga a crédito'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Cada plato que se cocina requiere su porción de insumos.'
                        ],
                        [
                            'id' => 3,
                            'pregunta' => '¿Cuál de los siguientes es un ejemplo clásico de Costo Fijo en un restaurante?',
                            'opciones' => [
                                'Salsa de tomate para pastas',
                                'Póliza de seguro contra incendios del local',
                                'Camarones para ceviche',
                                'Servilletas de papel consumidas por los clientes'
                            ],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'El seguro del local tiene una prima mensual fija independientemente del flujo de clientes.'
                        ],
                        [
                            'id' => 4,
                            'pregunta' => 'Si decides implementar servicio a domicilio y compras contenedores biodegradables por pedido, este costo es:',
                            'opciones' => [
                                'Costo Variable',
                                'Costo Fijo',
                                'Costo Financiero Inmueble',
                                'Depreciación'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'El gasto en empaques varía directamente con la cantidad de pedidos despachados.'
                        ],
                        [
                            'id' => 5,
                            'pregunta' => '¿Qué característica define mejor a los Costos Fijos?',
                            'opciones' => [
                                'Desaparecen cuando el restaurante cierra un día festivo',
                                'Se deben pagar puntualmente sin importar si hubo 1 o 1000 comensales',
                                'Siempre son más baratos que los costos variables',
                                'Son fijados únicamente por los meseros'
                            ],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'Los costos fijos son independientes del volumen de ventas a corto plazo.'
                        ],
                        [
                            'id' => 6,
                            'pregunta' => 'El sueldo pactado mensualmente para el Chef Ejecutivo contratado de planta es un:',
                            'opciones' => [
                                'Costo Fijo',
                                'Costo Variable Directo',
                                'Gasto Imprevisto',
                                'Costo de Oportunidad'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Los sueldos contractuales base son fijos a fin de mes.'
                        ],
                        [
                            'id' => 7,
                            'pregunta' => 'Si duplicas las ventas de tacos de 500 a 1000 órdenes esta semana, ¿qué le ocurrirá al costo total de carne y tortillas?',
                            'opciones' => [
                                'Permanecerá exactamente igual',
                                'Aumentará prácticamente al doble proporcionalmente',
                                'Disminuirá a la mitad',
                                'Se convertirá en costo fijo'
                            ],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'Al ser costos variables, el gasto en insumos aumenta al ritmo de la producción.'
                        ],
                        [
                            'id' => 8,
                            'pregunta' => 'La licencia municipal anual de funcionamiento del establecimiento culinario es:',
                            'opciones' => [
                                'Un Costo Variable por platillo',
                                'Un Costo Fijo del periodo',
                                'Un Margen de Contribución',
                                'Una Merma Culinaria'
                            ],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'El permiso de operación tiene una cuota establecida no ligada al número de comensales.'
                        ]
                    ]
                ]
            ],

            // ================= MÓDULO 2 =================
            [
                'orden' => 2,
                'slug' => 'calculo-de-la-merma',
                'titulo' => '2. Cálculo de Merma y Rendimiento',
                'icono' => 'ri-scales-3-line',
                'badge_categoria' => 'Control de Insumos',
                'descripcion' => 'Calcula el desperdicio inevitable (piel, grasa, merma técnica) para conocer el rendimiento real.',
                'formula' => 'Merma (%) = ((Peso Bruto - Peso Limpio) / Peso Bruto) * 100',
                'ejemplo' => 'Compras 2 kg de piña y tras pelarla obtienes 1.4 kg útiles. Desperdiciaste 0.6 kg (30% de merma, 70% de rendimiento).',
                'contenido_detallado' => [
                    'introduccion' => 'La merma es la pérdida de peso que sufre un insumo al pelarse, deshuesarse o cocinarse.',
                    'puntos_clave' => [
                        [
                            'titulo' => 'Peso Bruto (AP)',
                            'texto' => 'Peso total comprado al proveedor con piel, grasa y huesos.'
                        ],
                        [
                            'titulo' => 'Peso Limpio (EP)',
                            'texto' => 'Porción neta comestible que realmente entra a la receta.'
                        ]
                    ],
                    'regla_de_oro' => 'Nunca costees una receta con el peso bruto si solo usas la parte limpia.',
                    'modal_alert' => [
                        'titulo' => 'Alerta Crítica de Cocina',
                        'tipo' => 'warning',
                        'mensaje' => 'Si ignoras la merma, estarás cobrando al cliente menos gramos de los que compraste y asumirás el desperdicio de tu propio bolsillo.'
                    ]
                ],
                'ejercicio_interactivo' => [
                    'tipo' => 'calculo_guiado',
                    'instruccion' => 'Calcula la merma y rendimiento con los siguientes datos breves:',
                    'datos' => [
                        'producto' => 'Lomo de Salmón Entero',
                        'peso_bruto_kg' => 4.5,
                        'peso_limpio_kg' => 3.15,
                        'costo_por_kg_compra' => 280
                    ],
                    'solucion' => [
                        'merma_kg' => 1.35,
                        'merma_porcentaje' => 30.0,
                        'rendimiento_porcentaje' => 70.0
                    ]
                ],
                'quiz' => [
                    'banco_preguntas' => [
                        [
                            'id' => 1,
                            'pregunta' => 'Si compras 5 kg de cebolla y obtienes 4.25 kg limpios picados, ¿cuál es el porcentaje de merma?',
                            'opciones' => ['10%', '15%', '20%', '25%'],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'Merma = (5 - 4.25) / 5 = 0.75 / 5 = 15%.'
                        ],
                        [
                            'id' => 2,
                            'pregunta' => '¿Qué significa el concepto de Rendimiento en una prueba de escandallo?',
                            'opciones' => [
                                'El porcentaje aprovechable del ingrediente (100% - Merma%)',
                                'El tiempo de cocción en minutos',
                                'El valor de la propina',
                                'El descuento del proveedor'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'El rendimiento representa la fracción útil y comestible aprovechada.'
                        ],
                        [
                            'id' => 3,
                            'pregunta' => '¿Qué representa la sigla culinaria AP (As Purchased)?',
                            'opciones' => [
                                'Peso tal como se compra al proveedor con piel, hueso o suciedad',
                                'Porción ya servida en el plato del cliente',
                                'El costo de almacenamiento en el congelador',
                                'El peso después de hornear'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'AP es el peso bruto del ingrediente en el momento de la recepción de compra.'
                        ],
                        [
                            'id' => 4,
                            'pregunta' => 'Si compras 10 kg de naranjas y tras exprimirlas obtienes 4 kg de jugo, ¿cuál fue el rendimiento?',
                            'opciones' => ['40%', '60%', '25%', '10%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Rendimiento = 4 / 10 = 0.40 (40% de jugo útil y 60% de merma en cáscara y bagazo).'
                        ],
                        [
                            'id' => 5,
                            'pregunta' => '¿Qué término define al peso neto de un insumo listo para consumirse libre de desperdicio?',
                            'opciones' => [
                                'Edible Portion (EP)',
                                'As Purchased (AP)',
                                'Merma Neta (MN)',
                                'Costo Fijo (CF)'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'EP (Edible Portion) es la porción comestible o peso limpio.'
                        ],
                        [
                            'id' => 6,
                            'pregunta' => 'Si un ingrediente tiene un rendimiento del 85%, ¿cuánto representa su merma técnica?',
                            'opciones' => ['15%', '25%', '8.5%', '85%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Merma (%) = 100% - Rendimiento% = 100 - 85 = 15%.'
                        ],
                        [
                            'id' => 7,
                            'pregunta' => 'Compras 2 kg de fresas y descartas 200 gramos por hojas y magulladuras. ¿Cuál es el porcentaje de merma?',
                            'opciones' => ['10%', '20%', '5%', '15%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Merma = 0.200 kg / 2.000 kg = 0.10 (10%).'
                        ],
                        [
                            'id' => 8,
                            'pregunta' => '¿Por qué es un error grave calcular la merma solo "al ojo" en cocina profesional?',
                            'opciones' => [
                                'Porque genera variaciones invisibles de costos que alteran el precio real de cada platillo',
                                'Porque la sal pierde sabor',
                                'Porque los refrigeradores consumen más energía',
                                'Porque la comida tarda más en servirse'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Estimar sin medir pruebas de rendimiento oculta pérdidas económicas constantes.'
                        ]
                    ]
                ]
            ],

            // ================= MÓDULO 3 =================
            [
                'orden' => 3,
                'slug' => 'costo-unitario-absorbido',
                'titulo' => '3. Costo Unitario Absorbido',
                'icono' => 'ri-calculator-line',
                'badge_categoria' => 'Costeo Real',
                'descripcion' => 'Descubre cómo la merma eleva el costo real por kilo o gramo de la porción servida.',
                'formula' => 'Costo Real por kg Limpio = Costo Compra / (1 - (Merma% / 100))',
                'ejemplo' => 'Si compras 1 kg de carne a $100 pero pierde 20% en grasa, el kilo comestible no cuesta $100, cuesta $125.',
                'contenido_detallado' => [
                    'introduccion' => 'La merma no desaparece financieramente: su costo debe ser absorbido por la porción comestible restante.',
                    'puntos_clave' => [
                        [
                            'titulo' => 'Efecto Absorción',
                            'texto' => 'A mayor merma técnica, mayor es el costo real por gramo que entra al plato.'
                        ],
                        [
                            'titulo' => 'Fórmula Directa',
                            'texto' => 'Divide el costo de compra entre el rendimiento: Costo Limpio = Costo Compra / Factor Rendimiento.'
                        ]
                    ],
                    'regla_de_oro' => 'En el escandallo de la receta, multiplica la porción limpia por el Costo Absorbido, nunca por el precio de factura bruta.',
                    'modal_alert' => [
                        'titulo' => 'Ejemplo de Pérdida Oculta',
                        'tipo' => 'info',
                        'mensaje' => 'Si un filete tiene 50% de merma (como mariscos o pulpo), su costo real por kilo es exactamente el DOBLE del precio de compra.'
                    ]
                ],
                'ejercicio_interactivo' => [
                    'tipo' => 'simulador_absorcion',
                    'instruccion' => 'Mueve el slider de merma y observa cómo aumenta el costo real por kilo aprovechable:',
                    'precio_compra_base' => 120,
                ],
                'quiz' => [
                    'banco_preguntas' => [
                        [
                            'id' => 1,
                            'pregunta' => 'Compras carne a $200 el kg. Si tiene un 50% de merma, ¿cuánto cuesta 1 kg de carne limpia lista para cocinar?',
                            'opciones' => ['$250 MXN', '$300 MXN', '$400 MXN', '$100 MXN'],
                            'respuesta_correcta' => 2,
                            'explicacion' => 'Costo Real = $200 / 0.50 = $400 MXN por kg limpio.'
                        ],
                        [
                            'id' => 2,
                            'pregunta' => '¿Qué sucede si costeamos la receta con el precio de compra bruto y no con el costo absorbido?',
                            'opciones' => [
                                'Fijaremos un precio de venta bajo que causará pérdidas invisibles',
                                'Ganaremos más dinero',
                                'El platillo sabrá mejor',
                                'El proveedor nos cobrará menos'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Ignorar la merma absorbe el desperdicio del propio margen de ganancia.'
                        ],
                        [
                            'id' => 3,
                            'pregunta' => 'Si compras aguacate a $80/kg y tiene un rendimiento del 80% (20% merma en cáscara y hueso), ¿cuál es el costo real del kg de pulpa?',
                            'opciones' => ['$100 MXN', '$96 MXN', '$80 MXN', '$120 MXN'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Costo absorbido = $80 / 0.80 = $100 MXN por kg de pulpa limpia.'
                        ],
                        [
                            'id' => 4,
                            'pregunta' => 'Si un ingrediente tiene 0% de merma (aprovechamiento del 100%), ¿cuál es su costo absorbido?',
                            'opciones' => [
                                'Exactamente igual al precio de compra',
                                'El doble del precio de compra',
                                'Cero pesos',
                                'La mitad del precio de compra'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Al no haber merma, el peso bruto coincide con el peso limpio y su costo no se altera.'
                        ],
                        [
                            'id' => 5,
                            'pregunta' => 'Un pescado cuesta $150/kg. Al limpiarlo y filetearlo queda un rendimiento de solo el 50%. ¿Cuánto cuesta en realidad cada gramo servido?',
                            'opciones' => ['$0.30 por gramo', '$0.15 por gramo', '$0.45 por gramo', '$0.20 por gramo'],
                            'respuesta_correcta' => 0,
                            'explicacion' => '1 kg limpio cuesta $150 / 0.50 = $300. Dividido entre 1000g = $0.30 por gramo limpio.'
                        ],
                        [
                            'id' => 6,
                            'pregunta' => 'A medida que el porcentaje de merma de un alimento aumenta, ¿qué sucede con su costo unitario absorbido?',
                            'opciones' => [
                                'Aumenta exponencialmente',
                                'Disminuye',
                                'Permanece invariable',
                                'Se vuelve nulo'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Menos rendimiento significa que menos gramos deben pagar la totalidad de la compra.'
                        ],
                        [
                            'id' => 7,
                            'pregunta' => '¿Cómo se le conoce al principio de cargar el valor del desperdicio sobre la porción útil servible?',
                            'opciones' => [
                                'Principio de Absorción de Costos por Merma',
                                'Punto de Rotación de Inventario',
                                'Depreciación Acelerada de Cocina',
                                'Margen Bruto de Propina'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Es la absorción del costo de los residuos en las porciones limpias vendibles.'
                        ],
                        [
                            'id' => 8,
                            'pregunta' => 'Compras papas a $30 el kg. Tras pelarlas la merma es del 25% (rinde 75%). ¿Cuál es el costo absorbido por kg?',
                            'opciones' => ['$40 MXN', '$35 MXN', '$45 MXN', '$37.50 MXN'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Costo Real = $30 / 0.75 = $40 MXN por kg.'
                        ]
                    ]
                ]
            ],

            // ================= MÓDULO 4 =================
            [
                'orden' => 4,
                'slug' => 'punto-de-equilibrio',
                'titulo' => '4. Punto de Equilibrio (Break-Even)',
                'icono' => 'ri-line-chart-line',
                'badge_categoria' => 'Viabilidad',
                'descripcion' => 'Calcula cuántos platos debes vender en el mes para cubrir costos sin ganar ni perder dinero.',
                'formula' => 'Punto de Equilibrio = Costos Fijos Totales / (Precio Venta - Costo Variable)',
                'ejemplo' => 'Costos Fijos = $20,000. Precio = $150, Costo = $50 (ganas $100 por plato). Necesitas vender 200 platos al mes para no perder.',
                'contenido_detallado' => [
                    'introduccion' => 'Es la meta mínima de ventas que necesita el restaurante antes de ver un solo peso de ganancia libre.',
                    'puntos_clave' => [
                        [
                            'titulo' => 'Margen de Contribución',
                            'texto' => 'Precio de Venta - Costo Variable. Es lo que aporta cada plato para pagar la renta y los sueldos.'
                        ],
                        [
                            'titulo' => 'Zona de Ganancia',
                            'texto' => 'Una vez alcanzada la unidad de equilibrio, el margen de cada plato vendido a partir de ahí es ganancia neta.'
                        ]
                    ],
                    'regla_de_oro' => 'Divide tu meta mensual entre 30 días para saber cuántos platos debes despachar diariamente para estar en paz.',
                    'modal_alert' => [
                        'titulo' => 'Meta Diaria en Sala y Cocina',
                        'tipo' => 'tip',
                        'mensaje' => 'Si tu punto de equilibrio son 300 platos al mes, tu objetivo operativo son 10 platos por día solo para pagar gastos fijos.'
                    ]
                ],
                'ejercicio_interactivo' => [
                    'tipo' => 'calculadora_pe',
                    'instruccion' => 'Ajusta los valores y calcula cuántos platos necesitas vender:',
                    'cf_default' => 24000,
                    'precio_default' => 180,
                    'cv_default' => 60
                ],
                'quiz' => [
                    'banco_preguntas' => [
                        [
                            'id' => 1,
                            'pregunta' => 'Si tus Costos Fijos son $20,000, la pizza se vende en $200 y cuesta $80 prepararla, ¿cuál es el Punto de Equilibrio?',
                            'opciones' => ['100 pizzas', '167 pizzas', '250 pizzas', '300 pizzas'],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'Margen = 200 - 80 = $120. PE = 20,000 / 120 = 166.6 ≈ 167 pizzas.'
                        ],
                        [
                            'id' => 2,
                            'pregunta' => '¿Qué ocurre al vender una unidad por encima del punto de equilibrio?',
                            'opciones' => [
                                'Aporta directamente ganancia neta al negocio',
                                'Aumenta el costo fijo de la renta',
                                'Se debe cerrar el turno',
                                'Se pierde dinero'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Los costos fijos ya están cubiertos; el margen de contribución adicional es ganancia pura.'
                        ],
                        [
                            'id' => 3,
                            'pregunta' => '¿Cómo se define el Margen de Contribución Unitario (MCU)?',
                            'opciones' => [
                                'Precio de Venta menos Costo Variable Unitario',
                                'Costos Fijos divididos entre ventas',
                                'Sueldo de los meseros',
                                'Precio de Venta más Costo Total'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'MCU = Precio - Costo Variable. Es la cantidad que cada plato aporta para pagar costos fijos.'
                        ],
                        [
                            'id' => 4,
                            'pregunta' => 'Si logras reducir tus Costos Fijos (por ejemplo renegociando la renta), ¿qué le pasa a tu Punto de Equilibrio?',
                            'opciones' => [
                                'Disminuye (necesitas vender menos platos para ser rentable)',
                                'Aumenta considerablemente',
                                'No sufre ningún cambio',
                                'Se vuelve negativo'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Menos costos fijos facilitan alcanzar la meta de equilibrio con menor volumen de comensales.'
                        ],
                        [
                            'id' => 5,
                            'pregunta' => 'En el punto de equilibrio exacto, ¿cuánto dinero gana el restaurante?',
                            'opciones' => ['$0 (ni pérdidas ni ganancias)', 'El 50% de las ventas', '$10,000 fijos', 'El valor de las mermas'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'En el punto de equilibrio la utilidad neta es exactamente cero.'
                        ],
                        [
                            'id' => 6,
                            'pregunta' => 'Si tus ventas están por debajo del punto de equilibrio en el mes, el restaurante se encuentra en:',
                            'opciones' => [
                                'Zona de Pérdidas (números rojos)',
                                'Zona de Alta Utilidad',
                                'Superávit Financiero',
                                'Equilibrio Óptimo'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Vender menos de la meta de equilibrio significa que los ingresos no alcanzan para pagar los costos fijos.'
                        ],
                        [
                            'id' => 7,
                            'pregunta' => 'Un menú cuesta $100 producirlo y se vende en $150 (MCU = $50). Si los costos fijos son $10,000, ¿cuántos menús son necesarios?',
                            'opciones' => ['200 menús', '150 menús', '100 menús', '300 menús'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'PE = $10,000 / $50 = 200 menús al mes.'
                        ],
                        [
                            'id' => 8,
                            'pregunta' => '¿Cuál de las siguientes acciones incrementa el Punto de Equilibrio (haciendo más difícil llegar a la meta)?',
                            'opciones' => [
                                'Aumentar los gastos de renta o administración sin aumentar ventas ni precios',
                                'Optimizar el uso de materia prima reduciendo merma',
                                'Mejorar el precio de venta manteniendo la demanda',
                                'Negociar descuentos por volumen con proveedores'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Aumentar costos fijos eleva la cantidad de platillos que deben venderse.'
                        ]
                    ]
                ]
            ],

            // ================= MÓDULO 5 =================
            [
                'orden' => 5,
                'slug' => 'margen-de-utilidad',
                'titulo' => '5. Margen de Ganancia vs. Markup',
                'icono' => 'ri-percent-line',
                'badge_categoria' => 'Precios',
                'descripcion' => 'Aprende a fijar precios correctamente evitando el error clásico de sumar un porcentaje al costo.',
                'formula' => 'Precio de Venta = Costo Total / (1 - (Margen Deseado% / 100))',
                'ejemplo' => 'Si un plato cuesta $60 y deseas 70% de margen: divide $60 / 0.30 = $200. (Si le sumas 70% obtienes $102 y tu margen real baja al 41%).',
                'contenido_detallado' => [
                    'introduccion' => 'No confundas Markup (lo que sumas al costo) con Margen Real (el % de la venta que se queda en tu bolsillo).',
                    'puntos_clave' => [
                        [
                            'titulo' => 'Fórmula Correcta',
                            'texto' => 'Para un margen del 70%, divide el costo entre 0.30 (el complemento del 100%).'
                        ],
                        [
                            'titulo' => 'Food Cost Típico',
                            'texto' => 'El costo de insumos en un restaurante exitoso suele rondar entre el 28% y 35% del precio de la carta.'
                        ]
                    ],
                    'regla_de_oro' => 'Nunca fijes precios con Costo + X%. Divide siempre entre (1 - Margen deseado).',
                    'modal_alert' => [
                        'titulo' => 'El Error Más Común',
                        'tipo' => 'warning',
                        'mensaje' => 'Sumar 30% al costo NO te da un 30% de ganancia en ventas. Si cuesta $100 y lo vendes a $130, tu margen real es de solo 23%.'
                    ]
                ],
                'ejercicio_interactivo' => [
                    'tipo' => 'conversor_margen',
                    'instruccion' => 'Compara el cálculo erróneo habitual (Markup) contra la fijación correcta (Margen Real):',
                    'costo_plato' => 75
                ],
                'quiz' => [
                    'banco_preguntas' => [
                        [
                            'id' => 1,
                            'pregunta' => 'Si preparar una pasta cuesta $50 y deseas un 75% de margen (costo del 25%), ¿a cuánto debes venderla?',
                            'opciones' => ['$62.50 MXN', '$87.50 MXN', '$200.00 MXN', '$150.00 MXN'],
                            'respuesta_correcta' => 2,
                            'explicacion' => 'Precio = $50 / 0.25 = $200 MXN.'
                        ],
                        [
                            'id' => 2,
                            'pregunta' => 'Si vendes un postre a $100 y te costó $40 elaborarlo, ¿cuál es tu margen de ganancia bruta?',
                            'opciones' => ['60%', '40%', '150%', '25%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Margen = ((100 - 40) / 100) * 100 = 60%.'
                        ],
                        [
                            'id' => 3,
                            'pregunta' => '¿Cuál es la diferencia fundamental entre Margen y Markup?',
                            'opciones' => [
                                'El Margen se calcula sobre el precio de venta final; el Markup sobre el costo del insumo',
                                'Son exactamente la misma fórmula matemática con distinto nombre',
                                'El Markup se aplica solo en bebidas alcohólicas',
                                'El Margen es un impuesto gubernamental'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Margen es la porción retenida de la venta; Markup es el recargo sobre el costo.'
                        ],
                        [
                            'id' => 4,
                            'pregunta' => 'Si un platillo cuesta $30 y deseas que el costo de comida represente el 30% del precio (70% margen), ¿cuál es el precio?',
                            'opciones' => ['$100 MXN', '$39 MXN', '$60 MXN', '$130 MXN'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Precio = $30 / 0.30 = $100 MXN.'
                        ],
                        [
                            'id' => 5,
                            'pregunta' => 'Si a un plato que cuesta $100 le sumas directamente un "30% de ganancia" vendiéndolo en $130, ¿cuál es tu margen real?',
                            'opciones' => ['Solo 23.07%', 'Exactamente 30.0%', '42.5%', '70%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Margen Real = (130 - 100) / 130 = 30 / 130 = 23.07%.'
                        ],
                        [
                            'id' => 6,
                            'pregunta' => 'En la industria de restaurantes, ¿qué porcentaje de Costo de Alimentos (Food Cost) se considera generalmente saludable?',
                            'opciones' => ['Entre 28% y 35%', 'Entre 70% y 85%', 'Menos del 5%', 'Exactamente 50%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'El rango estándar de costo de materia prima suele rondar entre el 28% y 35% del precio.'
                        ],
                        [
                            'id' => 7,
                            'pregunta' => 'Para obtener un 60% de margen de ganancia sobre el precio de venta, ¿entre cuánto debes dividir el costo del platillo?',
                            'opciones' => ['Entre 0.40 (1 - 0.60)', 'Entre 1.60', 'Entre 0.60', 'Entre 6.0'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Se divide entre su complemento: 1 - 0.60 = 0.40.'
                        ],
                        [
                            'id' => 8,
                            'pregunta' => 'Si vendes una hamburguesa a $150 y su costo total de insumos fue de $45, ¿qué porcentaje representa el Food Cost?',
                            'opciones' => ['30%', '45%', '70%', '15%'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Food Cost % = (45 / 150) * 100 = 30%.'
                        ]
                    ]
                ]
            ],

            // ================= MÓDULO 6 =================
            [
                'orden' => 6,
                'slug' => 'simulador-financiero-integrador',
                'titulo' => '6. Simulador Financiero Integrador',
                'icono' => 'ri-dashboard-3-line',
                'badge_categoria' => 'Práctica Integral',
                'descripcion' => 'Integra todos los conceptos con controles en tiempo real para optimizar la rentabilidad.',
                'formula' => 'Utilidad Neta = Ventas Totales - Costos Variables Totales - Costos Fijos',
                'ejemplo' => 'Mueve los controles para ver cómo reducir un 5% la merma en cocina puede duplicar tus ganancias al final de mes.',
                'contenido_detallado' => [
                    'introduccion' => 'El laboratorio integrador donde alteras mermas, costos fijos y precios en vivo.',
                    'puntos_clave' => [
                        [
                            'titulo' => 'Impacto de la Merma',
                            'texto' => 'Reducir el desperdicio en cocina incrementa directamente la utilidad neta sin subir precios.'
                        ],
                        [
                            'titulo' => 'Volumen de Venta',
                            'texto' => 'A mayor número de comensales, menor es el impacto de los costos fijos por plato servido.'
                        ]
                    ],
                    'regla_de_oro' => 'En gastronomía, el sabor atrae clientes, pero el control de mermas y costos sostiene el negocio.',
                    'modal_alert' => [
                        'titulo' => 'Módulo Final Concluido',
                        'tipo' => 'success',
                        'mensaje' => '¡Has recorrido la ruta completa de costeo culinario! Ya dominas la clasificación, mermas, absorción, punto de equilibrio y fijación de precios.'
                    ]
                ],
                'ejercicio_interactivo' => [
                    'tipo' => 'simulador_completo',
                    'instruccion' => 'Prueba los controles interactivos en tiempo real:',
                ],
                'quiz' => [
                    'banco_preguntas' => [
                        [
                            'id' => 1,
                            'pregunta' => 'Si un restaurante mantiene sus precios y costos fijos, pero reduce su merma del 25% al 10%, ¿qué ocurrirá?',
                            'opciones' => [
                                'El costo por plato bajará y la ganancia neta aumentará',
                                'Aumentará el punto de equilibrio',
                                'Habrá pérdidas',
                                'No habrá ningún cambio financiero'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Menos desperdicio significa menor costo variable unitario y mayor margen.'
                        ],
                        [
                            'id' => 2,
                            'pregunta' => '¿Cuál de las siguientes acciones permite reducir el Punto de Equilibrio mensual?',
                            'opciones' => [
                                'Aumentar la merma de los ingredientes caros',
                                'Optimizar recetas, reducir desperdicios o negociar la renta',
                                'Bajar los precios sin reducir costos',
                                'Subir los sueldos fijos sin aumentar ventas'
                            ],
                            'respuesta_correcta' => 1,
                            'explicacion' => 'Al bajar costos fijos o variables, se necesitan menos platos para cubrir gastos.'
                        ],
                        [
                            'id' => 3,
                            'pregunta' => 'Si las ventas mensuales son $100,000, los costos variables $35,000 y los costos fijos $40,000, ¿cuál es la utilidad neta?',
                            'opciones' => ['$25,000 MXN', '$35,000 MXN', '$60,000 MXN', '$15,000 MXN'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Utilidad = 100,000 - 35,000 - 40,000 = $25,000 MXN.'
                        ],
                        [
                            'id' => 4,
                            'pregunta' => '¿Por qué controlar las mermas técnicas en cocina es más efectivo que simplemente aumentar precios?',
                            'opciones' => [
                                'Porque no ahuyenta a los clientes con precios altos y aprovecha al 100% el dinero invertido en compras',
                                'Porque la comida se enfría menos',
                                'Porque los proveedores regalan insumos',
                                'Porque reduce los impuestos de renta'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'La eficiencia interna genera ganancias inmediatas sin poner en riesgo la demanda del comensal.'
                        ],
                        [
                            'id' => 5,
                            'pregunta' => '¿Qué término resume la ganancia que queda después de restar todos los costos variables y fijos de las ventas totales?',
                            'opciones' => ['Utilidad Neta', 'Margen de Merma', 'Costo Bruto', 'Punto Cero'],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'La Utilidad Neta es el beneficio final disponible para los socios o reinversión.'
                        ],
                        [
                            'id' => 6,
                            'pregunta' => 'Si un restaurante vende 800 platos al mes y su punto de equilibrio son 500 platos, ¿cuántos platos representan beneficio neto directo?',
                            'opciones' => ['300 platos', '800 platos', '500 platos', '1300 platos'],
                            'respuesta_correcta' => 0,
                            'explicacion' => '800 - 500 = 300 platos por encima del punto de equilibrio.'
                        ],
                        [
                            'id' => 7,
                            'pregunta' => '¿Qué ocurre con el costo fijo unitario por plato cuando el volumen de comensales aumenta?',
                            'opciones' => [
                                'Disminuye (los costos fijos se reparten entre más platos)',
                                'Aumenta al doble',
                                'Permanece siempre estático',
                                'Se convierte en costo de merma'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Al haber más platos, cada uno absorbe una fracción menor del alquiler y nómina fija.'
                        ],
                        [
                            'id' => 8,
                            'pregunta' => '¿Cuál es el orden lógico para una gestión financiera culinaria exitosa?',
                            'opciones' => [
                                'Clasificar costos -> Medir merma -> Calcular costo absorbido -> Determinar equilibrio -> Fijar precios',
                                'Fijar precios al azar -> Esperar ganancias -> Pagar renta si sobra',
                                'Cocinar sin fichas técnicas -> Cobrar lo mismo que la competencia',
                                'Calcular impuestos -> Comprar ingredientes sin registrar peso'
                            ],
                            'respuesta_correcta' => 0,
                            'explicacion' => 'Seguir la ruta metódica de costeo garantiza la rentabilidad sostenible del negocio.'
                        ]
                    ]
                ]
            ]
        ];

        foreach ($lecciones as $item) {
            ConceptoFinanciero::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
