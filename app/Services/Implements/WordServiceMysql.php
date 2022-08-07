<?php

namespace App\Services\Implements;

use App\Services\Interfaces\WordServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class WordServiceMysql implements WordServiceInterface
{
    public function getFirstN(Model $model, int $count = 21): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $model::query()->orderBy('id')->paginate($count);
    }

    public function lookUp(Model $model, string $text, int $resultsBefore = 20, int $resultsAfter = 20): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if ($text == '') {
            return $model::query()->paginate($resultsBefore + $resultsAfter);
        }
        $target = $model::query()
            ->where('word', 'like', $text . '%')->first();
        if ($target != null) {
            $next = $model::query()
                ->where('id', '>', ($target->id))
                ->orderBy('id');
            $nextCount = $next->take($resultsAfter)->count();
            $prev = $model::query()
                ->where('id', '<=', ($target->id))
                ->orderByDesc('id');
            $prevCount = $prev->take($resultsBefore)->count();

            if ($nextCount < $resultsBefore) {
                $resultsAfter += $resultsBefore - $nextCount;
            } else if ($prevCount < $resultsAfter) {
                $resultsBefore += $resultsAfter - $prevCount;
            }

            return $prev
                ->take($resultsAfter)
                ->union($next->take($resultsBefore))
                ->select()
                ->orderBy('id')
                ->paginate($resultsBefore + $resultsAfter + 1);
        }
        return new LengthAwarePaginator([], 0, 0);
    }
}
