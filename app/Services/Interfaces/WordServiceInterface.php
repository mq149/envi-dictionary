<?php

namespace App\Services\Interfaces;

use App\Models\BaseModels\Word;
use Illuminate\Database\Eloquent\Model;

interface WordServiceInterface
{
    public function lookUp(Word $model, string $text, int $resultsBefore = 10, int $resultsAfter = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}
