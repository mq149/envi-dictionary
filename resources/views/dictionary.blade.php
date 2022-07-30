<link href="{{ asset('css/dictionary/meaning.css') }}" rel="stylesheet">

<x-app-layout>
    <div class="h-full">
{{--        <router-view/>--}}
        <dictionary
            :laravel-version="'{{Illuminate\Foundation\Application::VERSION}}'"
            :php-version="'{{PHP_VERSION}}'">
        </dictionary>
    </div>
</x-app-layout>
