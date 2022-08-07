<?php

if (!function_exists('in_debug_mode')) {
    function in_debug_mode(): bool
    {
        return config('app.debug');
    }
}

if (!function_exists('is_using_mongodb')) {
    function is_using_mongodb(): bool
    {
        return config('database.default') == 'mongodb';
    }
}
