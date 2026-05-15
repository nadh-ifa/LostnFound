<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_add_comment()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson("/api/items/{$item->id}/comments", [
                'comment' => 'Saya melihat barang ini di lobby.',
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('comments', [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'comment' => 'Saya melihat barang ini di lobby.',
        ]);
    }

    public function test_guest_cannot_add_comment()
    {
        $item = Item::factory()->create();

        $response = $this->postJson("/api/items/{$item->id}/comments", [
            'comment' => 'Komentar dari guest.',
        ]);

        $response->assertStatus(401);
    }
}