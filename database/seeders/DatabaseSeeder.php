<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Kategori::factory(3)->create();
        Bahan::factory(20)->create();
        Resep::factory(10)->create();

        $this->call(BahanResepSeeder::class);
    }
}
