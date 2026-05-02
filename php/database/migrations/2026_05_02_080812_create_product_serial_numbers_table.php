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
        Schema::create('product_serial_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('serial_number', 100)->nullable()->unique();
            $table->string('sku', 100)->nullable();
            $table->enum('status', ['IN', 'OUT', 'DEFECTIVE', 'RETURNED'])->default('IN');
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // FOREIGN KEY
            $table->foreign('product_id')->references('id')->on('products')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_serial_numbers');
    }
};
