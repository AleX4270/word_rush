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
     * TODO: Get a bigger list from somewhere else in the future. Make it update automatically.
     */
    public function run(): void {
        //Pies
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

        //Kubek
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

        //Kaczka
        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_PL)->value('id'),
            'content' => 'Kaczka',
            'character_count' => 6
        ]);

        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_EN)->value('id'),
            'content' => 'Duck',
            'character_count' => 4
        ]);

        //Atlas
        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_PL)->value('id'),
            'content' => 'Atlas',
            'character_count' => 5
        ]);

        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_EN)->value('id'),
            'content' => 'Atlas',
            'character_count' => 5
        ]);

        //Jeż
        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_PL)->value('id'),
            'content' => 'Paliwo',
            'character_count' => 6
        ]);

        DB::table('word')->insert([
            'language_id' => Language::query()->where('code', Utility::LANG_EN)->value('id'),
            'content' => 'Fuel',
            'character_count' => 4
        ]);
    }
}
