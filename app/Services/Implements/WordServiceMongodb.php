<?php

namespace App\Services\Implements;

use App\Services\Interfaces\WordServiceInterface;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class WordServiceMongodb implements WordServiceInterface
{
    public function getFirstN(Model $model, int $count = 21): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $model->setConnection('mongodb');
        return $model::query()->orderBy('id')->paginate($count);
    }

    public function lookUp(Model $model, string $text, int $resultsBefore = 20, int $resultsAfter = 20): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $model->setConnection('mongodb');
        $total = $resultsBefore + $resultsAfter;
        if ($text == '') {
            return $model::query()->paginate($total);
        }
        $target = $model::query()
            ->where('word', 'like', $text . '%')->first();
        if ($target != null) {
            $projection = ['_id' => 0];
            $next = $model::query()
                ->where('id', '>', ($target->id))
                ->project($projection)
                ->orderBy('id')
                ->take($total)->get()->toArray();
            $nextCount = count($next);
            $prev = $model::query()
                ->where('id', '<=', ($target->id))
                ->project($projection)
                ->orderByDesc('id')
                ->take($total)->get()->toArray();
            $prevCount = count($prev);
            if ($nextCount < $resultsBefore) {
                $resultsAfter += $resultsBefore - $nextCount;
            } else if ($prevCount < $resultsAfter) {
                $resultsBefore += $resultsAfter - $prevCount;
            }
            $prevResult = array_slice($prev, 0, $resultsBefore);
            $nextResult = array_slice($next, 0, $resultsAfter);
            $result = array_merge($prevResult, $nextResult);
            $ids = array_column($result, 'id');
            array_multisort($ids, SORT_ASC, $result);
            return new LengthAwarePaginator($result,
                $resultsBefore + $resultsAfter + 1,
                $resultsBefore + $resultsAfter + 1);
        }
        return new LengthAwarePaginator([], 1, 1);
    }
}
