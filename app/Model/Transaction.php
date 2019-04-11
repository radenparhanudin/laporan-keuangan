<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function product()
    {
        return $this->hasOne('App\Model\Product', 'product_id', 'id');
    }
}
