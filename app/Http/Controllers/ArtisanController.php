<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{

    public function migrate()
    {
        // Ejecutar solo las migraciones específicas de departure_dates
        $migrations = [
            'database/migrations/2025_11_14_125818_create_departure_dates_table.php',
            'database/migrations/2025_11_14_125904_add_departure_date_id_to_shopping_table.php'
        ];
        
        $output = '';
        
        foreach ($migrations as $migration) {
            if (file_exists(base_path($migration))) {
                Artisan::call('migrate', [
                    '--path' => $migration,
                    '--force' => true
                ]);
                $output .= Artisan::output();
            }
        }
        
        // Ejecutar el seeder después de las migraciones
        Artisan::call('db:seed', [
            '--class' => 'MigrateDepartureDatesToNewTableSeeder',
            '--force' => true
        ]);
        
        $output .= "\n\n" . Artisan::output();

        Artisan::call('migrate', [
            '--path' => "database/migrations/2025_11_14_132320_remove_departure_date_from_products_table.php",
            '--force' => true
        ]);

        return nl2br($output) . '<br><br><strong>Migrations and seeder executed successfully!</strong>';
    }

    public function seedCategories()
    {
        Artisan::call('db:seed', ['--class' => 'CategorySeeder' , '--force' => true ]);
        return 'Category seeder executed successfully';
    }
    public function cache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return 'Cache cleared successfully';
    }
}