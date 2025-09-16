<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\ProcessVideo;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('dispatch', function () {

 retry(5, function ( ) {
    ProcessVideo::dispatch();
    });
})->purpose('Test job dispatching');
