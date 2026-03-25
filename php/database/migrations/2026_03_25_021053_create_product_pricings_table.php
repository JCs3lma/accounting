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
        Schema::create('product_pricings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->decimal('cost_price', 10, 2)->index();
            $table->decimal('selling_price', 10, 2)->nullable()->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('product_id')->references('id')->on('products')->onDelete('RESTRICT');
            // INDEXES
            $table->index(['product_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pricings');
    }
};
