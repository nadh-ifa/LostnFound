<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReceptionistTest extends TestCase
{
    use RefreshDatabase;

    public function test_receptionist_can_update_item_status()
    {
        $receptionist = User::factory()->create([
            'role' => 'resepsionis',
        ]);

        $item = Item::factory()->create([
            'status' => 'dilaporkan',
        ]);

        $response = $this->actingAs($receptionist, 'sanctum')
            ->patchJson("/api/items/{$item->id}/status", [
                'status' => 'ada_di_resepsionis',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'status' => 'ada_di_resepsionis',
        ]);
    }

    public function test_normal_user_cannot_update_item_status()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->patchJson("/api/items/{$item->id}/status", [
                'status' => 'ada_di_resepsionis',
            ]);

        $response->assertStatus(403);
    }
}