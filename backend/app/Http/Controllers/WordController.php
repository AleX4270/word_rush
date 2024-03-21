<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WordService;

class WordController extends Controller {
    private WordService $wordService;

    public function __construct(WordService $wordService) {
        $this->wordService = $wordService;
    }

    public function get(Request $request) {
        $params = $request->input('params');

        $wordData = $this->wordService->get($params);

        return response()->json([
            'status' => 'success',
            'data' => $wordData
        ], 200);
    }
}
