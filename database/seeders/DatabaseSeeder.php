<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('DROP EXTENSION IF EXISTS unaccent');
        DB::statement('CREATE EXTENSION unaccent');

        $this->call([
            StateSeeder::class,
            CitySeeder::class,
        ]);
    }
}
