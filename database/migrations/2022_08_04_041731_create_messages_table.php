<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 200);
            $table->string('title', 200);
            $table->bigInteger('phone')->length(11)->nullable();
            $table->string('email', 255)->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 255)->default('unread');
            $table->string('created_by', 25)->nullable();
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
        Schema::dropIfExists('message');
    }
}
