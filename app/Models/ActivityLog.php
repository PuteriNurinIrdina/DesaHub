<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';
    protected $fillable = ['activityType', 'activityDetails', 'account_id',]; // Include account_id

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}