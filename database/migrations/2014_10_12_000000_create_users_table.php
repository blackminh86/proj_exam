<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('fullname')->nullable();
            $table->string('status', 255);
            $table->timestamp('email_verified_at')->useCurrent();
            $table->string('password',255);
            $table->string('avatar')->nullable();
            $table->string('level',50);
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_by', 255)->nullable();
            $table->string('modified_by', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
