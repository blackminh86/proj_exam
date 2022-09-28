<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->foreignId('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade');
            $table->foreignId('attribute_id')
                 ->references('id')->on('attributes')
                 ->onDelete('cascade');  
            $table->string('value')->length(50); 
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
        Schema::dropIfExists('attribute_products');
    }
}
