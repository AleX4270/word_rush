<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WordService;

class WordController extends Controller {
    private WordService $wordService;

    public function __construct(WordService $wordService) {
        $this->wordService = $wordService;
    }

    public function letters(Request $request) {
        $secondsElapsed = $request->input('seconds');
        $languageSymbol = $request->input('language');

        $data = $this->wordService->getLetters($secondsElapsed, $languageSymbol);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function check(Request $request, int $id) {
        $params = [
            'word' => $request->input('word')
        ];

        $data = $this->wordService->checkWord($params, $id);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
}
