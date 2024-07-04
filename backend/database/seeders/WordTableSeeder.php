<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Constants\Utility;

class WordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_PL)->value('id'),
            'content' => 'Pies',
            'character_count' => 4
        ]);

        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_EN)->value('id'),
            'content' => 'Dog',
            'character_count' => 3
        ]);

        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_PL)->value('id'),
            'content' => 'Kubek',
            'character_count' => 5
        ]);

        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_EN)->value('id'),
            'content' => 'Mug',
            'character_count' => 3
        ]);
    }
}
