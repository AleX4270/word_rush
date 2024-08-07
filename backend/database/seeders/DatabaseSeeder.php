<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LanguageTableSeeder;
use Database\Seeders\WordTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Word_Rush',
            'email' => 'none',
        ]);
        $this->call(LanguageTableSeeder::class);
        $this->call(WordTableSeeder::class);
    }
}
