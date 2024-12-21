<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'state' => 'nacional'],
            ['id' => 2, 'state' => 'internacional'],
            ['id' => 3, 'state' => 'aereo'],
            ['id' => 4, 'state' => 'escapada']
        ];

        foreach ($categories as $category) {
            if (!Category::find($category['id'])) {
                Category::factory()->withId($category['id'])->{$category['state']}()->create();
            }
        }
    }
}