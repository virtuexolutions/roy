<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('brand');
            $table->string('type');
            $table->string('sku');
            $table->string('designer');
            $table->longText('description')->nullable();
            $table->string('gender');
            $table->text('notes');
            $table->string('year_introduced');
            $table->string('recommended_use');
            $table->string('msrp');
            $table->float('wholsale_price');
            $table->text('large_image');
            $table->text('small_image');
            $table->string('url');
            $table->string('upc');
            $table->integer('stock')->default(1);
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
