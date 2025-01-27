<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'code',
        'description',
        'price'
    ];

    /**
     * @return array
     */
    public static function getOption(): array
    {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
