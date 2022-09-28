<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade');
            $table->foreignId('product_id');
            $table->foreignId('variation_product_id');
            $table->tinyInteger('amount');
            $table->integer('order_price');
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
        Schema::dropIfExists('product_orders');
    }
}
