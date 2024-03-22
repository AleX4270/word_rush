<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WordService {

    public function __construct() {

    }

    public function get(array $params) {
        $randomWord = DB::table('word')->inRandomOrder()->first();
        $randomWordLetters = str_split($randomWord->content);

        if(count($randomWordLetters) < 1) {
            throw new ModelNotFoundException('Word not found');
        }

        //Save downloaded word in user related db table row so it can be verified later.

        $hiddenLettersCount = $randomWord->character_count - $params['secondsElapsed'];
        $wordWithHiddenLetters = $this->hideRandomLetters($randomWordLetters, $hiddenLettersCount);
        return [
            'count' => count($randomWordLetters),
            'items' => $wordWithHiddenLetters
        ];
    }

    private function hideRandomLetters(array $wordLetters, int $hiddenLettersCount) {
        $randomIndex = 0;
        $generatedIndexes = [];
        for($i = 0; $i < $hiddenLettersCount; $i++) {
            $generatedIndexes[$i] = [];
            while(!in_array($randomIndex, $generatedIndexes[$i])) {
                $randomIndex = rand(0, count($wordLetters) - 1);
                $generatedIndexes[$i][] = $randomIndex;
            }


            $wordLetters[$randomIndex] = '_';
        }

        return $wordLetters;
    }
}