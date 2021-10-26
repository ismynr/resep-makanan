<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\Resep;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BahanResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $bahan = Bahan::pluck('id')->toArray();
        $resep = Resep::pluck('id')->toArray();

        for ($i = 0; $i < count($bahan); $i++) {
            DB::table('bahan_resep')->insert([
                'bahan_id' => $faker->randomElement($bahan),
                'resep_id' => $faker->randomElement($resep),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
