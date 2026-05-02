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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->longText('description')->nullable();
            $table->string('logo_path', 255)->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('unit')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('barcode', 50)->nullable()->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // FOREIGN KEY
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('RESTRICT');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('RESTRICT');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
