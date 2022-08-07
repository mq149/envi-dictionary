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

    public function __construct(private WordServiceInterface $wordService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        if ($request->has('text')) {
            $vietnameseWords = $this->wordService->lookUp(new VietnameseWord(), $request->get('text', ''));
        } else {
            $vietnameseWords = $this->wordService->getFirstN(new VietnameseWord());
        }
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
