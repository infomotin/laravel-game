<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPreferences;

class UserPreferencesService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function set($key, $value)
    {
        $userId = Auth::id();
        UserPreferences::updateOrCreate(
            ['user_id' => $userId, 'preference_key' => $key],
            ['preference_value' => $value]
        );

    }
    public function get($key, $default = null)
    {
        $userId = Auth::id();
        $preference = UserPreferences::where('user_id', $userId)
            ->where('preference_key', $key)
            ->first();

        return $preference ? $preference->preference_value : $default;
    }
}
