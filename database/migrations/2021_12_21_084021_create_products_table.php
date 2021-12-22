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
            $table->longText('description')->nullable();
            $table->longText('summary')->nullable();
            $table->integer('stock')->default(0);
            $table->string('price')->default(0);
            $table->string('discount')->default(0);
            $table->string('offer_price')->default(0);
            $table->string('photo');
            $table->string('size');
            $table->string('weight')->nullable();
            $table->enum('condition', ['new', 'used','popular','hot','winter'])->default('new');
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->softDeletes();
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
