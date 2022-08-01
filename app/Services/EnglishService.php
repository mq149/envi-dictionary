<?php

namespace App\Services;

use App\Models\EnglishWord;
use App\Services\Implements\WordServiceImplement;
use Illuminate\Http\Request;

class EnglishService extends WordServiceImplement
{

    public function index(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->lookUp(new EnglishWord(), $request->get('text', ''));
    }
}
