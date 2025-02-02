<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade'); // Foreign key to fournisseurs
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade'); // Foreign key to warehouses
            // Removed 'product_id' column based on your previous request
            $table->decimal('quantity', 10, 2)->nullable(false); // Quantity of the product
            $table->decimal('price', 10, 2)->nullable(false); // Price of the product
            $table->timestamp('purchase_date')->useCurrent(); // Purchase date with current timestamp as default
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid'); // Payment status enum
            $table->decimal('amount_to_pay', 10, 2)->default(0.00); // Amount to pay
            $table->decimal('reduction', 10, 2)->default(0.00); // Reduction amount
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
