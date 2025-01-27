<?php

namespace Ccns\CcnsEcommerceCart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'product',
        'options',
        'price',
        'quantity',
        'total_price',
    ];

    protected $casts = [
        'product' => 'array',
        'options' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
