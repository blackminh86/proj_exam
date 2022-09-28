<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->foreignId('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            $table->integer('price')->length(9)->nullable();
            $table->string('variation')->nullable();
            $table->string('variation_ecommerce_id')->length(25)->nullable(); 
            $table->string('thumbnail')->nullable()->length(250); 
            $table->string('status')->nullable()->length(25);  
            $table->string('seller_id')->nullable()->length(25);  
            $table->string('created_by', 255)->nullable();
            $table->string('modified_by', 255)->nullable();
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
        Schema::dropIfExists('variation_products');
    }
}
