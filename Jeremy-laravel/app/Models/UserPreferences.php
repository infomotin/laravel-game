<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreferences extends Model
{
    protected $table = 'user_preferences';
    protected $fillable = ['user_id', 'preference_key', 'preference_value'];
}
