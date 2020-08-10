<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecycleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recycle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('itemName');
            $table->string('itemDescription');
            $table->string('collector')->nullable();
            $table->string('electronics')->nullable();
            $table->string('biological')->nullable();
            $table->integer('phoneNumber');
            $table->string('duration');
            $table->text('avatar1');
            $table->text('avatar2')->nullable();
            $table->text('avatar3')->nullable();
            $table->text('avatar4')->nullable();
            $table->text('avatar5')->nullable();
            $table->text('avatar6')->nullable();
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
        Schema::dropIfExists('recycle');
    }
}
