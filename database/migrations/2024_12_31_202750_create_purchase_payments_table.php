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
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade'); // Foreign key to purchases table
            $table->decimal('amount', 15, 2); // Payment amount
            $table->string('payment_method')->nullable(); // Payment method (e.g., cash, card)
            $table->string('transaction_reference')->nullable(); // Transaction reference 
            $table->date('payment_date'); // Date of payment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_payments');
    }
};
