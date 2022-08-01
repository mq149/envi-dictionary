<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\EnglishWord;
use App\Services\Interfaces\WordServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EnglishController extends Controller
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
    public function index(Request $request)
    {
        $englishWords = $this->wordService->lookUp(new EnglishWord(), $request->get('text', ''));
        return WordResource::collection($englishWords);
    }

    /**
     * Display the specified resource.
     *
     * @param EnglishWord $englishWord
     * @return WordResource
     */
    public function show(EnglishWord $englishWord): WordResource
    {
        return new WordResource($englishWord);
    }
}
