<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface WordServiceInterface
{
    public function lookUp(Model $model, string $text, int $resultsBefore = 10, int $resultsAfter = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}
