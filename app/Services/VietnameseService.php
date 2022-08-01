<?php

namespace App\Services;

use App\Models\VietnameseWord;
use App\Services\Implements\WordServiceImplement;
use Illuminate\Http\Request;

class VietnameseService extends WordServiceImplement
{

    public function index(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->lookUp(new VietnameseWord(), $request->get('text', ''));
    }
}
