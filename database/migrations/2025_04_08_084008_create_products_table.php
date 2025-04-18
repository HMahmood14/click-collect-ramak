<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->uuid()->unique();
            $blueprint->string('name');
            $blueprint->longText('description');
            $blueprint->decimal('price', 8, 2);
            $blueprint->foreignId('category_id')->constrained()->onDelete('cascade');
            $blueprint->timestamps();
        });
    }
};
