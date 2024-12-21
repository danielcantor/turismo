<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function migrate()
    {
        Artisan::call('migrate');
        return 'Migrations executed successfully';
    }

    public function seedCategories()
    {
        Artisan::call('db:seed', ['--class' => 'CategorySeeder']);
        return 'Category seeder executed successfully';
    }
}