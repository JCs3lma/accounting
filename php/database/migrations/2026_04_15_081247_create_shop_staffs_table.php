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
        Schema::create('shop_staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('staff_id');
            $table->enum('employment_status', ['Regular', 'Project Base', 'Seasonal', 'Probationary'])->nullable();
            $table->date('hire_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // FOREIGN KEY
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('RESTRICT');
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_staffs');
    }
};
