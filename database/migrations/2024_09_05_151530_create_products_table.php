<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('thumb_image');
            $table->integer('vendor_id');
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('child_category_id')->nullable();
            $table->integer('brand_id');
            $table->integer('qty');
            $table->text('short_description');
            $table->text('long_description');
            $table->text('video_link')->nullable();
            $table->string('sku')->nullable();
            $table->double('price', 8, 2);
            $table->double('offer_price', 8, 2)->nullable();
            $table->date('offer_start')->nullable();
            $table->date('offer_end')->nullable();
            $table->boolean('is_new')->nullable();
            $table->boolean('is_top')->nullable();
            $table->boolean('is_best')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('status');
            $table->integer('is_approved')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
