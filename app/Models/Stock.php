<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id',
        'quantity'
    ];
}
