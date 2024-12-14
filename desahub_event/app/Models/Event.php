<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event_module';
    protected $fillable = [
        'name',
        'date',
        'type',
        'desc',
        'poster'

    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($event) {
            $date = Carbon::parse($event->date);
            $event->day_of_week = $date->format('l'); // Monday, Tuesday, etc.
            $event->month = $date->format('F'); // January, February, etc.
            $event->year = $date->year; // e.g., 2024
        });
    }
}
