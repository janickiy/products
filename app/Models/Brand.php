<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'name',
    ];
}
