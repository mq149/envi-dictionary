<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Model;

class WordMysql extends Model
{
    protected $connection = 'mysql';
    protected $attributes = ['id', 'word', 'html', 'description', 'pronounce'];
}
