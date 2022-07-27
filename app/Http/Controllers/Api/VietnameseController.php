<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\VietnameseWord;

class VietnameseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vietnameseWords = VietnameseWord::simplePaginate(20);
        return WordResource::collection($vietnameseWords);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VietnameseWord  $vietnameseWord
     * @return \Illuminate\Http\Response
     */
    public function show(VietnameseWord $vietnameseWord)
    {
        return new WordResource($vietnameseWord);
    }
}
