<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('featured_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('display_order')->unique();
            $table->string('featured_image_path');
            $table->timestamps();
        });

        // Add check constraint for maximum 3 products
        DB::statement('ALTER TABLE featured_products ADD CONSTRAINT max_featured_products CHECK (display_order <= 3)');
    }

    public function down()
    {
        Schema::dropIfExists('featured_products');
    }
};