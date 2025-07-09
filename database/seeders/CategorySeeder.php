<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Category::factory(10)->create(); */

        Category::create(['name' => 'Marca']);
        Category::create(['name' => 'Série']);
        Category::create(['name' => 'Tamanho']);
        Category::create(['name' => 'Cor']);
    }
}
