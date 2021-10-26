<?php

namespace Tests\Feature\Api;

use App\Models\Bahan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BahanApiControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->json('get', route('api.bahan.index'))
            ->assertStatus(200);
    }

    public function test_store()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => 'Apa aja',
            'jumlah' => 'Secukupnya',
        ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
    }

    public function test_store_bahan_null_with_update_request_validation()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => '',
            'jumlah' => 'Secukupnya',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['bahan']);
    }

    public function test_store_jumlah_null_with_update_request_validation()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => 'apa aja',
            'jumlah' => '',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['jumlah']);
    }

    public function test_store_bahan_min_3_character_with_update_request_validation()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => '1',
            'jumlah' => 'Secukupnya',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['bahan']);
    }

    public function test_store_jumlah_min_2_character_with_update_request_validation()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => 'apa aja',
            'jumlah' => '2',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['jumlah']);
    }

    public function test_store_bahan_max_100_character_with_update_request_validation()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => $this->faker->realTextBetween(101,110),
            'jumlah' => 'Secukupnya',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['bahan']);
    }

    public function test_store_jumlah_max_50_character_with_update_request_validation()
    {
        $this->json('post', route('api.bahan.store'), [
            'bahan' => 'apa aja',
            'jumlah' => $this->faker->realTextBetween(51,60),
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['jumlah']);
    }

    public function test_show()
    {
        $bahan = Bahan::factory()->create();

        $this->json('get', route('api.bahan.show', $bahan->id))
        ->assertStatus(200);
    }

    public function test_show_not_found()
    {
        $this->json('get', route('api.bahan.show', 0))
        ->assertStatus(404);
    }

    public function test_update() 
    {
        $bahan = Bahan::factory()->create();

        $this->json('put', route('api.bahan.update', $bahan->id), [
            'bahan' => 'Mencoba Sneidir',
            'jumlah' => 'Secukupnya',
        ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
    }

    public function test_update_id_not_found() 
    {
        $this->json('put', route('api.bahan.update', 0), [
            'bahan' => 'Mencoba Sneidir',
            'jumlah' => 'Secukupnya',
        ])
        ->assertStatus(404);
    }

    public function test_destroy() 
    {
        $bahan = Bahan::factory()->create();

        $this->json('delete', route('api.bahan.destroy', $bahan->id))
            ->assertStatus(200);
    }

    public function test_destroy_id_not_found() 
    {
        $this->json('delete', route('api.bahan.destroy', 0))
            ->assertStatus(404);
    }
}