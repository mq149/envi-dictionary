<?php

namespace App\Services\Interfaces;

use App\Models\BaseModels\Word;

interface WordServiceInterface
{
    public function getFirstN(Word $model, int $count = 21): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function lookUp(Word $model, string $text, int $resultsBefore = 10, int $resultsAfter = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}
