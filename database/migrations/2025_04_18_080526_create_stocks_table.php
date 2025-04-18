<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
        Schema::create('stocks', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->uuid()->unique();
            $blueprint->foreignId('product_id')->constrained()->onDelete('cascade');
            $blueprint->integer('quantity');
            $blueprint->date('date')->default(now());
            $blueprint->timestamps();
        });
    }
};
