<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proprietary;

class ProprietarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proprietary::create([
            'name' => 'items',
        ]);

        Proprietary::create([
            'name' => 'categories',
        ]);

        Proprietary::create([
            'name' => 'extras',
        ]);

        Proprietary::create([
            'name' => 'proprietaries',
        ]);

        Proprietary::create([
            'name' => 'sections',
        ]);

        Proprietary::create([
            'name' => 'tags',
        ]);
    }
}
