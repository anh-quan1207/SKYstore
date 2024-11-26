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
        Schema::create('rating_reviews', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('productVariant_id');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->text('comment');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on("customers")->onDelete('cascade');
            $table->foreign('productVariant_id')->references('id')->on("product_variants")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_reviews');
    }
};
