<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_display', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('display_image_path');
            $table->integer('display_order')->unique();
            $table->timestamps();
        });

        // Add check constraint for maximum 4 categories
        DB::statement('ALTER TABLE category_display ADD CONSTRAINT max_categories CHECK (display_order <= 4)');
    }

    public function down()
    {
        Schema::dropIfExists('category_display');
    }
};