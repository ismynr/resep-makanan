<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resep::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kategori = Kategori::pluck('id')->toArray();
        
        return [
            'kategori_id' => $this->faker->randomElement($kategori),
            'nama' => $this->faker->realTextBetween(5,30),
            'deskripsi' => $this->faker->realTextBetween(5,100),
        ];
    }
}
