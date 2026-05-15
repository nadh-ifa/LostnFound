<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'title' => 'Kunci Motor',
            'description' => 'Kunci motor hilang di parkiran',
            'location' => 'Parkiran Kampus',
            'type' => 'hilang',
            'status' => 'dilaporkan',

            'date_event' => now()->toDateString(),
        ];
    }
}