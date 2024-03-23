<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Word;

class WordService {

    public function __construct() {}

    public function getLetters(array $params) {
        $randomWord = Word::query()
            ->inRandomOrder()
            ->first();

        $randomWordLetters = str_split($randomWord->content);

        if(count($randomWordLetters) < 1) {
            throw new ModelNotFoundException('Word not found');
        }

        $hiddenLettersCount = $randomWord->character_count - $params['secondsElapsed'];
        $wordWithHiddenLetters = $this->hideRandomLetters($randomWordLetters, $hiddenLettersCount);
        return [
            'wordId' => $randomWord->id, //This cannot be transferred with letters - it's temporary
            'letters' => $wordWithHiddenLetters
        ];
    }

    public function checkWord(array $params, int $wordId) {
        $generatedWord = Word::query()->select(['id', 'content'])
            ->where('id', $wordId)
            ->firstOrFail();

        $isGuessCorrect = !empty($params['word']) &&
            (strtolower(trim($params['word'])) === strtolower($generatedWord->content));

        return [
            'isValid' => $isGuessCorrect
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