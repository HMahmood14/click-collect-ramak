<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stock) {
            $stock->uuid = (string) Str::uuid();
        });
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
