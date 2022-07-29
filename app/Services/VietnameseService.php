<?php

namespace App\Services;

use App\Models\VietnameseWord;
use App\Traits\LookUpTrait;
use Illuminate\Http\Request;

class VietnameseService
{
    use LookUpTrait;

    public function index(Request $request)
    {
        if ($request->has('text')) {
            return $this->lookUp((new VietnameseWord()), $request->get('text'));
        }
        return VietnameseWord::query()->paginate(20);
    }
}
