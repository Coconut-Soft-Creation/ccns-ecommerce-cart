<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('cart_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->json('options')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price')->default(0);
            $table->decimal('subtotal')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
