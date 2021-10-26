<?php

namespace Tests\Feature\Api;

use App\Models\Resep;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResepApiControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->json('get', route('api.resep.index'))
            ->assertStatus(200);
    }

    public function test_store()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => 1,
            'nama' => 'Secukupnya',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
    }

    public function test_store_kategori_null_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => '',
            'nama' => 'Ayam Bakar',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['kategori_id']);
    }

    public function test_store_nama_null_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => 1,
            'nama' => '',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['nama']);
    }

    public function test_store_bahan_null_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => 1,
            'nama' => 'Ayam Bakar',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => ''
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['bahan']);
    }

    public function test_store_kategori_numeric_character_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => '1adfs',
            'nama' => 'Ayam Bakar',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['kategori_id']);
    }

    public function test_store_nama_min_5_character_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => 1,
            'nama' => '2',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['nama']);
    }

    public function test_store_nama_max_100_character_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => 1,
            'nama' => $this->faker()->realTextBetween(101,110),
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['nama']);
    }

    public function test_store_deskripsi_min_5_character_with_update_request_validation()
    {
        $this->json('post', route('api.resep.store'), [
            'kategori_id' => 1,
            'nama' => 'Ayam Bakar',
            'deskripsi' => 'adf',
            'bahan' => [1,6,8]
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['deskripsi']);
    }

    public function test_show()
    {
        $resep = Resep::factory()->create();

        $this->json('get', route('api.resep.show', $resep->id))
        ->assertStatus(200);
    }

    public function test_show_not_found()
    {
        $this->json('get', route('api.resep.show', 0))
        ->assertStatus(404);
    }

    public function test_update() 
    {
        $resep = Resep::factory()->create();

        $this->json('put', route('api.resep.update', $resep->id), [
            'kategori_id' => 1,
            'nama' => 'Ikan Bakar',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,6]
        ])
        ->assertStatus(200)
        ->assertSessionHasNoErrors();
    }

    public function test_update_id_not_found() 
    {
        $this->json('put', route('api.resep.update', 0), [
            'kategori_id' => 1,
            'nama' => 'Ikan Bakar',
            'deskripsi' => 'adfadsfadfadfa',
            'bahan' => [1,2]
        ])
        ->assertStatus(404);
    }

    public function test_destroy() 
    {
        $resep = Resep::factory()->create();

        $this->json('delete', route('api.resep.destroy', $resep->id))
            ->assertStatus(200);
    }

    public function test_destroy_id_not_found() 
    {
        $this->json('delete', route('api.resep.destroy', 0))
            ->assertStatus(404);
    }
}
