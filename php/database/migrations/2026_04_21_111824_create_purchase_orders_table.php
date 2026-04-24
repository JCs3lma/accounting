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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->nullable()->unique();
            $table->unsignedBigInteger('supplier_id');
            $table->date('order_date');
            $table->date('expected_date')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Received', 'Cancelled'])->default('Pending');

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // FOREIGN KEY
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('RESTRICT');
            $table->foreign('created_by')->references('id')->on('staffs')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
