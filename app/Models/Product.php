<?php
declare(strict_types=1);

namespace App\Models;

use App\ProductTypes\KiloProduct;
use App\ProductTypes\PieceProduct;
use App\ProductTypes\ProductBase;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @property-read \App\Models\Stock|null $currentStock
 */

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
        'price',
        'category_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->uuid = (string) Str::uuid();
        });
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function currentStock(): HasOne
    {
        return $this->hasOne(Stock::class)->latestOfMany();
    }

    public function asType(): ProductBase
    {
        return match ($this->type) {
            'kilo' => new KiloProduct($this),
            'piece' => new PieceProduct($this),
            default => throw new \Exception("Onbekend producttype: {$this->type}")
        };
    }
}
