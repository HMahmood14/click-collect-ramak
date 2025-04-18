<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->uuid()->unique();
            $blueprint->foreignId('customer_id')->constrained()->onDelete('cascade');
            $blueprint->decimal('total_price', 8, 2);
            $blueprint->dateTime('pickup_time');
            $blueprint->enum('status', ['pending', 'completed'])->default('pending');
            $blueprint->timestamps();
        });
    }
};
