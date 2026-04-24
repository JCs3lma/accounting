<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('product_id');

            $table->integer('quantity');

            $table->decimal('price', 12, 2);
            $table->decimal('total', 12, 2);

            $table->timestamps();
            $table->softDeletes();

            // FOREIGN KEY
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('RESTRICT');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
