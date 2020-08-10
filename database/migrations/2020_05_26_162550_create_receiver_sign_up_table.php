<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiverSignUpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiverSignUp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyName')->nullable();
            $table->string('agentName');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('zipcode')->nullable();
            $table->integer('phoneNumber');
            $table->boolean('electronics')->nullable();
            $table->boolean('biological')->nullable();
            $table->boolean('collector')->nullable();
            $table->string('userName');
            $table->string('password');
            $table->string('passwordConfirm');
            $table->boolean('mobile')->nullable();
            $table->boolean('paying')->nullable();
            $table->boolean('private')->nullable();
            $table->boolean('selling')->nullable();
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
        Schema::dropIfExists('receiverSignUp');
    }
}
