<?php

namespace App\Models;

use Database\Factories\StockFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stock) {
            $stock->uuid = (string) Str::uuid();
        });
    }

    protected static function newFactory(): Factory
    {
        return StockFactory::new();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
