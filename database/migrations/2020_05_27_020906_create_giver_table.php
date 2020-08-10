<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giver', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->integer('phoneNumber');
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('state');
            $table->string('country');
            $table->integer('zipcode')->nullable();
            $table->boolean('mobile')->nullable();
            $table->boolean('selling')->nullable();
            $table->string('userName');
            $table->string('password');
            $table->string('passwordConfirm');
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
        Schema::dropIfExists('giver');
    }
}
