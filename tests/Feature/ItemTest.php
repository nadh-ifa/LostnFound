<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_items()
    {
        Item::factory()->create([
            'title' => 'Kunci Motor',
            'type' => 'hilang',
            'status' => 'dilaporkan',
        ]);

        $response = $this->getJson('/api/items');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => 'Kunci Motor',
        ]);
    }

    public function test_authenticated_user_can_create_item()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/items', [
                'title' => 'Dompet Hitam',
                'description' => 'Dompet hilang di mushola',
                'location' => 'Mushola FILKOM',
                'type' => 'hilang',
                'date_event' => '2026-05-15',
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('items', [
            'title' => 'Dompet Hitam',
            'user_id' => $user->id,
        ]);
    }

    public function test_guest_cannot_create_item()
    {
        $response = $this->postJson('/api/items', [
            'title' => 'Dompet Hitam',
            'description' => 'Dompet hilang',
            'location' => 'Mushola',
            'type' => 'hilang',
            'date_event' => '2026-05-15',
        ]);

        $response->assertStatus(401);
    }
}