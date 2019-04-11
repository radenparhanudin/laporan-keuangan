<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
