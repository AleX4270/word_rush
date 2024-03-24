<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\WordService;

class WordServiceTest extends TestCase {
    public function testHideRandomLetters() {
        $wordService = new WordService();

        $testWord = 'hello';
        $letters = str_split($testWord);
        $hiddenLettersCount = 2;

        $result = $wordService->hideRandomLetters($letters, $hiddenLettersCount);

        $realHiddenLettersCount = 0;
        foreach($result as $letter) {
            if($letter === "_") {
                $realHiddenLettersCount++;
            }
        }

        $this->assertEquals($hiddenLettersCount, $realHiddenLettersCount);

    }
}