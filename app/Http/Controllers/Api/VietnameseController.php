<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\VietnameseWord;
use App\Services\Interfaces\WordServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VietnameseController extends Controller
{
    private WordServiceInterface $wordService;

    public function __construct(WordServiceInterface $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $vietnameseWords = $this->wordService->lookUp(new VietnameseWord(), $request->get('text', ''));
        return WordResource::collection($vietnameseWords);
    }

    /**
     * Display the specified resource.
     *
     * @param VietnameseWord $vietnameseWord
     * @return WordResource
     */
    public function show(VietnameseWord $vietnameseWord): WordResource
    {
        return new WordResource($vietnameseWord);
    }
}
