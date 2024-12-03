<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterEvent extends Model
{
    use HasFactory;
    
    protected $table = '_event_registration';
    
    protected $fillable = [
        'ic_num',
        'name',
        'phone_num',
        'gender',
        'address',
        'poscode',
        'email',
        'state',
        'house_category',
        'age_class',
        'attendance',
    ];

    public function setAttendanceAttribute($value)
    {
        if ($value == 'Hadir') {
            $this->attributes['attendance'] = 1;
        } else {
            $this->attributes['attendance'] = 0;
        }
    }

    public function getAttendanceAttribute($value)
    {
        return $value == 1 ? 'Hadir' : 'Tidak Hadir';
    }
}
