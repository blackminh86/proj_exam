<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;
class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            {
                    $table->increments('id')->unsigned(); 
                    $table->string('name', 255);
                    $table->string('status', 255);
                    $table->string('created_by', 255)->nullable();
                    $table->string('modified_by', 255)->nullable();
                    $table->string('is_home', 255)->nullable();
                    $table->string('display', 255)->nullable();
                    $table->nestedSet();
                    $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
