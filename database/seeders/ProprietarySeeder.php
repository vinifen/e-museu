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
            'full_name' => 'UNICENTRO',
            'contact' => 'unicentro@unicentro.com',
            'blocked' => '0',
            'is_admin' => '1'
        ]);

        Proprietary::create([
            'full_name' => 'UTFPR',
            'contact' => 'utfpr@utfpr.com',
            'blocked' => '0',
            'is_admin' => '1'
        ]);

        Proprietary::factory(30)->create();
    }
}
