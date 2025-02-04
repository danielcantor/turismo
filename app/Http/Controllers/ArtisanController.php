<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function migrate()
    {
        Artisan::call('migrate:fresh', ['--force' => true ]);
        return 'Migrations executed successfully';
    }

    public function seedCategories()
    {
        Artisan::call('db:seed', ['--class' => 'CategorySeeder' , '--force' => true ]);
        return 'Category seeder executed successfully';
    }
    public function cache()
    {
        Artisan::call('cache:clear');
        return 'Cache cleared successfully';
    }
}