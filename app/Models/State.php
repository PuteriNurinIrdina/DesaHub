<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['state_name', 'country_id'];

    // Scope to get states only for Malaysia (assuming country_id = 1 for Malaysia)
    public function scopeMalaysia($query)
    {
        return $query->where('country_id', 132); // Filter for Malaysia states
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}