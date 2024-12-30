<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'qty',
        'link',
        'price',
        'category',
        'description',
        'image',
        'account_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
