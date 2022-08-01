<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\VietnameseWord;
use App\Services\VietnameseService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VietnameseController extends Controller
{
    private $vietnameseService;

    public function __construct(VietnameseService $vietnameseService)
    {
        $this->vietnameseService = $vietnameseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $vietnameseWords = $this->vietnameseService->index($request);
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
