<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class GaugeReading extends Model
{
    /** @use HasFactory<\Database\Factories\GaugeReadingFactory> */
    use HasFactory;
    use Searchable;

    // protected $guarded = [];

}
