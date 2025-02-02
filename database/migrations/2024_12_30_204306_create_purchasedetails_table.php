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
        Schema::create('purchasedetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade'); // Links to purchases table
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Links to products table
            $table->foreignId('product_unit_id')->constrained()->onDelete('cascade');     // Links to units table
            $table->integer('quantity'); // Purchased quantity
            $table->decimal('unit_price', 10, 2); // Price per unit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasedetails');
    }
};


