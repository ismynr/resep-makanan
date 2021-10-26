<?php

namespace Tests\Feature\Api;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriApiControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->json('get', route('api.kategori.index'))
            ->assertStatus(200);
    }

    public function test_store()
    {
        $this->json('post', route('api.kategori.store'), [
            'kategori' => 'Makanan Minuman Tok'
        ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
    }

    public function test_store_kategori_null_with_update_request_validation()
    {
        $this->json('post', route('api.kategori.store'), [
            'kategori' => ''
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['kategori']);
    }

    public function test_store_kategori_min_5_character_with_update_request_validation()
    {
        $this->json('post', route('api.kategori.store'), [
            'kategori' => '1'
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['kategori']);
    }

    public function test_store_kategori_max_50_character_with_update_request_validation()
    {
        $this->json('post', route('api.kategori.store'), [
            'kategori' => $this->faker->realTextBetween(51,60)
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['kategori']);
    }

    public function test_show()
    {
        $kategori = Kategori::factory()->create();

        $this->json('get', route('api.kategori.show', $kategori->id))
        ->assertStatus(200);
    }

    public function test_show_not_found()
    {
        $this->json('get', route('api.kategori.show', 0))
        ->assertStatus(404);
    }

    public function test_update() 
    {
        $kategori = Kategori::factory()->create();

        $this->json('put', route('api.kategori.update', $kategori->id), [
            'kategori' => 'Mencoba Sneidir'
        ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
    }

    public function test_update_id_not_found() 
    {
        $this->json('put', route('api.kategori.update', 0), [
            'kategori' => 'Mencoba Sneidir'
        ])
        ->assertStatus(404);
    }

    public function test_destroy() 
    {
        $kategori = Kategori::factory()->create();

        $this->json('delete', route('api.kategori.destroy', $kategori->id))
            ->assertStatus(200);
    }

    public function test_destroy_id_not_found() 
    {
        $this->json('delete', route('api.kategori.destroy', 0))
            ->assertStatus(404);
    }
}
