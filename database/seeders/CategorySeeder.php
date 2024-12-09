<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()->nacional()->create();
        Category::factory()->internacional()->create();
        Category::factory()->aereo()->create();
        Category::factory()->micro()->create();
        Category::factory()->escapada()->create();
        Category::factory()->finde()->create();
    }
}