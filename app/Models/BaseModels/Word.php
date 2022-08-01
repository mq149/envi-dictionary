<?php

namespace App\Models\BaseModels;

if (config('database.default') == 'mongodb') {
    class DynamicWordModel extends WordMongodb {}
}
else {
    class DynamicWordModel extends WordMysql {}
}

class Word extends DynamicWordModel { }
