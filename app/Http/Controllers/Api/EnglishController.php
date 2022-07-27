<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\EnglishWord;

class EnglishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $englishWords = EnglishWord::simplePaginate(20);
        return WordResource::collection($englishWords);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnglishWord  $englishWord
     * @return \Illuminate\Http\Response
     */
    public function show(EnglishWord $englishWord)
    {
        return new WordResource($englishWord);
    }
}
