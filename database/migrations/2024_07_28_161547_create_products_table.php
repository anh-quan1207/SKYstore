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
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('name');
            $table->unsignedInteger('price');
            $table->unsignedInteger('sold_quantity')->default(0);
            $table->unsignedInteger('remain_quantity')->default(0);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('discount')->default(0);
            $table->unsignedInteger('default_product_variant_id')->default(0);
            $table->unsignedInteger('category_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on("categories")->onDelete('cascade');
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
