<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_api()
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);
    }
    
    public function test_store_api()
    {
        $data = ['name' => 'tornillo'];

        $response = $this->post('/api/items', $data);

        $response->assertStatus(201);
    }

    public function test_update_api()
    {
        $items = Item::factory()->create();

        $data = ['name' => 'tornillo', 'amount' => 200];

        $response = $this->put('/api/items', $data);

        $response->assertStatus(201);
    }
}
