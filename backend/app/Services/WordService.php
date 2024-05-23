<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Word;

class WordService {

    public function __construct() {}

    public function getLetters(int $secondsElapsed, string $languageSymbol): array {
        try {
            $randomWord = Word::query()
                ->select(['word.id', 'word.content'])
                ->join('language as l', 'word.language_id', '=', 'l.id')
                ->where('l.code', $languageSymbol)
                ->where('l.is_active', 1)
                ->inRandomOrder()
                ->first();

            $randomWordLetters = str_split($randomWord->content);

            if(count($randomWordLetters) < 1) {
                throw new ModelNotFoundException('Word not found');
            }

            $hiddenLettersCount = strlen($randomWord->content) - $secondsElapsed;

            if($hiddenLettersCount > 0) {
                $wordWithHiddenLetters = $this->hideRandomLetters($randomWordLetters, $hiddenLettersCount);
                $isGuessable = true;
            }
            else {
                $isGuessable = false;
            }

            return [
                'wordId' => $randomWord->id,
                'letters' => $wordWithHiddenLetters ?? [],
                'hiddenLettersCount' => $hiddenLettersCount,
                'isGuessable' => $isGuessable
            ];
        }
        catch(\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    public function checkWord(array $params, int $wordId): array {
        $generatedWord = Word::query()->select(['id', 'content'])
            ->where('id', $wordId)
            ->firstOrFail();

        $isGuessCorrect = !empty($params['word']) &&
            (strtolower(trim($params['word'])) === strtolower($generatedWord->content));

        return [
            'isValid' => $isGuessCorrect
        ];
    }

    public function hideRandomLetters(array $wordLetters, int $hiddenLettersCount): array {
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