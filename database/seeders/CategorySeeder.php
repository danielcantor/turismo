<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Eliminar registros existentes en lugar de truncate debido a foreign keys
        DB::table('category')->delete();

        $categories = [
            [
                'id' => 1,
                'name' => 'Tours Nacionales',
                'slug' => 'tours-nacionales',
                'description' => 'Descubre los mejores destinos nacionales con nuestros tours especializados.',
                'image' => 'categories/nacional.jpg',
                'home_image' => 'categories/home-nacional.jpg',
                'subtitle' => 'Explora tu país',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Tours Internacionales',
                'slug' => 'tours-internacionales',
                'description' => 'Vive experiencias únicas en destinos internacionales.',
                'image' => 'categories/internacional.jpg',
                'home_image' => 'categories/home-internacional.jpg',
                'subtitle' => 'Aventuras globales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Paquetes Aéreos',
                'slug' => 'paquetes-aereos',
                'description' => 'Viaja cómodo con nuestros paquetes que incluyen vuelos.',
                'image' => 'categories/aereo.jpg',
                'home_image' => 'categories/home-aereo.jpg',
                'subtitle' => 'Vuela alto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Escapadas de Fin de Semana',
                'slug' => 'escapadas-weekend',
                'description' => 'Relájate con nuestras escapadas cortas perfectas para el fin de semana.',
                'image' => 'categories/escapada.jpg',
                'home_image' => 'categories/home-escapada.jpg',
                'subtitle' => 'Desconecta y disfruta',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('category')->insert($categories);
    }
}