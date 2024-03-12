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
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')-> constrained('categories','id');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedFloat('price',8,2);
            $table->unsignedFloat('compare_price')->nullable();
            $table->unsignedFloat('cost')->nullable();
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->string('sku')->unique()->nullable();
            $table->string('barcode')->nullable();
            $table->enum('status',['active','draft','archived'])->default('active');
            $table->enum('availabillty',['in-stock','out-of-stock','back-order'])->default('in-stock');
            $table->timestamps();
            $table->softDeletes();
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
