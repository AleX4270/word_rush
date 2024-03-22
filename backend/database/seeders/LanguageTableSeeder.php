<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('language')->insert([
            ['code' => 'pl', 'name' => 'Polski', 'is_active' => true],
            ['code' => 'en', 'name' => 'English', 'is_active' => true]
        ]);
    }
}
