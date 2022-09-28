<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('thumb',250);
            $table->string('link',200)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('type', 25);
            $table->string('created_by', 25)->nullable();
            $table->string('modified_by', 25)->nullable();;     
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
        Schema::dropIfExists('banners');
    }
}
