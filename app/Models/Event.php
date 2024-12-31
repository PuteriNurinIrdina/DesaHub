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
        'poster',
        'state_id',
        'city_id',
        'state_name',
        'city_name',
        'event_time',
        'address',
        'max_participants',
        'whatsapp_group_link'

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

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getTypeLabelAttribute()
    {
        $types = [
            'type1' => 'ICT',
            'type2' => 'Keusahawanan',
            'type3' => 'Pusat Aktiviti & Pemerkasaan Wanita',
            'type4' => 'Pusat Aktiviti Kesukarelawan',
            'type5' => 'Pusat Latihan Komuniti',
            'type6' => 'Pusat Pengumpulan Produk Usahawan Desa',
            'type7' => 'Pusat Perkhidmatan Setempat',
            'type8' => 'Lain-Lain',
        ];

        return $types[$this->type] ?? 'Unknown';
    }

    public function getFormattedEventTimeAttribute()
    {
        if ($this->event_time) {
            return \Carbon\Carbon::createFromFormat('H:i:s', $this->event_time)->format('h:i A');
        }
        return null; // Or a default value like 'N/A'
    }

    public function registration()
    {
        return $this->hasOne(EventRegistration::class, 'event_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    
}
