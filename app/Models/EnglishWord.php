<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnglishWord extends Word
{
    use HasFactory;

    protected $table = 'av';
}
