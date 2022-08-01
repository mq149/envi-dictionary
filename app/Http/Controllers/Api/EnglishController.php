<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\EnglishWord;
use App\Services\EnglishService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EnglishController extends Controller
{
    private $englishService;

    public function __construct(EnglishService $englishService)
    {
        $this->englishService = $englishService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $englishWords = $this->englishService->index($request);
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
