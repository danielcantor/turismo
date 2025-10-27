<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eliminar registros existentes en lugar de truncate debido a foreign keys
        DB::table('products')->delete();

        $products = [
            [
                'product_name' => 'Tour Cataratas del Iguazú',
                'product_price' => '15000',
                'product_description' => 'Descubre una de las maravillas naturales más impresionantes del mundo. Tour completo de día entero a las Cataratas del Iguazú con guía especializado.',
                'product_type' => 1, // Nacional
                'product_category' => 1, // Tours Nacionales
                'product_image' => 'products/iguazu.jpg',
                'product_slider' => 'products/slider/iguazu-1.jpg,products/slider/iguazu-2.jpg',
                'product_activate' => 1,
                'days' => 1,
                'nights' => 0,
                'departure_date' => '2025-11-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Bariloche - Lagos y Montañas',
                'product_price' => '35000',
                'product_description' => 'Escapada de 3 días a San Carlos de Bariloche. Incluye alojamiento, desayuno y excursiones a Cerro Catedral y Circuito Chico.',
                'product_type' => 1, // Nacional
                'product_category' => 4, // Escapadas
                'product_image' => 'products/bariloche.jpg',
                'product_slider' => 'products/slider/bariloche-1.jpg,products/slider/bariloche-2.jpg',
                'product_activate' => 1,
                'days' => 3,
                'nights' => 2,
                'departure_date' => '2025-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Brasil - Río de Janeiro',
                'product_price' => '75000',
                'product_description' => 'Vive la experiencia carioca completa. 5 días en Río de Janeiro con vuelos incluidos, alojamiento en Copacabana y tours a Cristo Redentor y Pan de Azúcar.',
                'product_type' => 2, // Internacional
                'product_category' => 2, // Internacional
                'product_image' => 'products/rio.jpg',
                'product_slider' => 'products/slider/rio-1.jpg,products/slider/rio-2.jpg',
                'product_activate' => 1,
                'days' => 5,
                'nights' => 4,
                'departure_date' => '2025-11-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Europa Clásica - 10 Días',
                'product_price' => '180000',
                'product_description' => 'Tour por las capitales europeas más importantes: París, Londres, Roma y Madrid. Incluye vuelos, alojamiento y tours guiados.',
                'product_type' => 2, // Internacional
                'product_category' => 3, // Aéreo
                'product_image' => 'products/europa.jpg',
                'product_slider' => 'products/slider/europa-1.jpg,products/slider/europa-2.jpg',
                'product_activate' => 1,
                'days' => 10,
                'nights' => 9,
                'departure_date' => '2025-12-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Mendoza - Ruta del Vino',
                'product_price' => '28000',
                'product_description' => 'Tour enológico por las mejores bodegas de Mendoza. Incluye degustaciones, almuerzo gourmet y transporte.',
                'product_type' => 1, // Nacional
                'product_category' => 4, // Escapadas
                'product_image' => 'products/mendoza.jpg',
                'product_slider' => 'products/slider/mendoza-1.jpg,products/slider/mendoza-2.jpg',
                'product_activate' => 1,
                'days' => 2,
                'nights' => 1,
                'departure_date' => '2025-11-25',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('products')->insert($products);

        // También crear algunos productos usando factory para variedad
        Product::factory(5)->create();
    }
}
