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
            $table->bigIncrements('id');
            $table->string('name')->length(300)->nullable();
            $table->foreignId('product_category_id')->nullable();
            $table->string('ecommerce_id')->length(25)->nullable();
            $table->string('status')->length(50)->nullable();
            $table->text('short_description')->nullable();
            $table->string('draft')->length(50)->nullable();
            $table->integer('price')->length(9)->nullable();
            $table->integer('list_price')->length(9)->nullable();
            $table->json('images')->nullable();
            $table->json('content')->nullable();
            $table->string('type')->length(20)->nullable();
            $table->string('type')->length(20)->default('normal');
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
        Schema::dropIfExists('products');
    }
}
