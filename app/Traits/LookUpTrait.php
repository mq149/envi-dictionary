<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

trait LookUpTrait
{

    protected function lookUp(Model $model, string $text, int $resultsBefore = 10, int $resultsAfter = 10): \Illuminate\Contracts\Pagination\Paginator
    {
        $target = $model::query()
            ->where('word', 'like', $text . '%')->first();
        if ($target != null) {
            $next = $model::query()
                ->where('id', '>', ($target->id))
                ->orderBy('id');
            $nextCount = $next->limit($resultsAfter)->count();
            $prev = $model::query()
                ->where('id', '<=', ($target->id))
                ->orderByDesc('id');
            $prevCount = $prev->limit($resultsBefore)->count();

            if ($nextCount < $resultsBefore) {
                $resultsAfter += $resultsBefore - $nextCount;
            } else if ($prevCount < $resultsAfter) {
                $resultsBefore += $resultsAfter - $prevCount;
            }

            return $prev
                ->limit($resultsAfter)
                ->union($next->limit($resultsBefore))
                ->select()
                ->orderBy('id')
                ->simplePaginate($resultsBefore + $resultsAfter + 1);
        }
        return new Paginator(0, 0, 0);
    }
}
