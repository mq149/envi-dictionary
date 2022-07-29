<?php

namespace App\Services;

use App\Models\EnglishWord;
use App\Traits\LookUpTrait;
use Illuminate\Http\Request;

class EnglishService
{
    use LookUpTrait;

    public function index(Request $request)
    {
        if ($request->has('text')) {
            return $this->lookUp((new EnglishWord()), $request->get('text'));
        }
        return EnglishWord::query()->paginate(20);
    }
}
