<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->uuid()->unique();
            $blueprint->string('name');
            $blueprint->string('email')->unique();
            $blueprint->string('phone');
            $blueprint->timestamps();
        });
    }
};
