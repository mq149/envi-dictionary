<?php

namespace App\Models\BaseModels;

use Jenssegers\Mongodb\Eloquent\Model;

class WordMongodb extends Model
{
    protected $connection = 'mongodb';
    protected $attributes = ['id', 'word', 'html', 'description', 'pronounce'];
}
