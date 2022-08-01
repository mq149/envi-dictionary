<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Jenssegers\Mongodb\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $attributes = ['id', 'word', 'html', 'description', 'pronounce'];
}
