<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProprietarySeeder::class,
            CategorySeeder::class,
            SectionSeeder::class,
            ItemSeeder::class,
            ExtraSeeder::class,
            TagSeeder::class,
            ContributionSeeder::class,
        ]);
    }
}
