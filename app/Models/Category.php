<?php
declare(strict_types=1);

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->uuid = (string) Str::uuid();
        });
    }
}
