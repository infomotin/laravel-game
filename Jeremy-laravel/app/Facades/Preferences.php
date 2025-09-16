<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Preferences extends Facade
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    protected static function getFacadeAccessor()
    {
        return \App\Services\UserPreferencesService::class;
    }
}
