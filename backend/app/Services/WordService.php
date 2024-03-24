<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Word;

class WordService {

    public function __construct() {}

    public function getLetters(int $secondsElapsed) {
        $randomWord = Word::query()
            ->inRandomOrder()
            ->first();

        $randomWordLetters = str_split($randomWord->content);

        if(count($randomWordLetters) < 1) {
            throw new ModelNotFoundException('Word not found');
        }

        $hiddenLettersCount = strlen($randomWord->content) - $secondsElapsed;
        $wordWithHiddenLetters = $this->hideRandomLetters($randomWordLetters, $hiddenLettersCount);
        return [
            'wordId' => $randomWord->id,
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

    public function hideRandomLetters(array $wordLetters, int $hiddenLettersCount) {
        $generatedIndexes = [];
        for($i = 0; $i < $hiddenLettersCount; $i++) {
            $randomIndex = rand(0, count($wordLetters) - 1);
            while(in_array($randomIndex, $generatedIndexes)) {
                $randomIndex = rand(0, count($wordLetters) - 1);
            }
            $generatedIndexes[] = $randomIndex;

            $wordLetters[$randomIndex] = '_';
        }

        return $wordLetters;
    }
}