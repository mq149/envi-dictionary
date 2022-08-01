<?php

namespace App\Services\Implements;

use App\Services\Interfaces\WordServiceInterface;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class WordServiceMongodb implements WordServiceInterface
{
    public function lookUp(Model $model, string $text, int $resultsBefore = 10, int $resultsAfter = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $model->setConnection('mongodb');
        if ($text == '') {
            return $model::query()->paginate($resultsBefore + $resultsAfter);
        }
        $target = $model::query()
            ->where('word', 'like', $text . '%')->first();
        if ($target != null) {
            $projection = ['_id' => 0];
            $next = $model::query()
                ->where('id', '>', ($target->id))
                ->project($projection)
                ->orderBy('id');
            $nextCount = $next->take($resultsAfter)->count();
            $prev = $model::query()
                ->where('id', '<=', ($target->id))
                ->project($projection)
                ->orderByDesc('id');
            $prevCount = $prev->take($resultsBefore)->count();
            if ($nextCount < $resultsBefore) {
                $resultsAfter += $resultsBefore - $nextCount;
            } else if ($prevCount < $resultsAfter) {
                $resultsBefore += $resultsAfter - $prevCount;
            }
            $prevResult = $prev->take($resultsAfter)->get()->toArray();
            $nextResult = $next->take($resultsBefore)->get()->toArray();
            $result = array_merge($prevResult, $nextResult);
            $ids = array_column($result, 'id');
            array_multisort($ids, SORT_ASC, $result);
            return new LengthAwarePaginator($result,
                $resultsBefore + $resultsAfter + 1,
                $resultsBefore + $resultsAfter + 1);
        }
        return new LengthAwarePaginator([], 0, 0);
    }
}
