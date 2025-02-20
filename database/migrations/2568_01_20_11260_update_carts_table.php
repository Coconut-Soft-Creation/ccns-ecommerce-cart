<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->index('id');
            $table->index('user_id');
            $table->string('session_id')->nullable()->index();

            $table->dropColumn('product');
            $table->dropColumn('options');
            $table->dropColumn('price');
            $table->dropColumn('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex('id');
            $table->dropIndex('user_id');
            $table->dropColumn('session_id');
            $table->json('product')->nullable();
            $table->json('options')->nullable();
            $table->decimal('price');
            $table->integer('quantity');
            $table->decimal('total_price');
        });
    }
};
