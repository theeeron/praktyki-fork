<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create();
        \App\Models\Post::factory(3)->create(['user_id' => $user->id]);

        $user2 = \App\Models\User::factory()->create();
        \App\Models\Post::factory(3)->create(['user_id' => $user2->id]);
    }
}
