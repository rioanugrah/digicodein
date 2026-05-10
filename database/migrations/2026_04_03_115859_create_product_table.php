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
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('product_category_id');
            $table->string('slug');
            $table->string('product_code')->index();
            $table->string('product_name');
            $table->text('product_description');
            $table->double('product_price');
            $table->integer('product_quantity');
            $table->text('product_link')->nullable();
            $table->text('product_link_description')->nullable();
            $table->text('product_image_cover')->nullable();
            $table->text('product_image')->nullable();
            $table->enum('status',['Active','Inactive','SoldOut','Verification']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
