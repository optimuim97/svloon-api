<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->text('description');
            $table->string('imageUrl');
            $table->text('abouUs');
            $table->string('schedule');
            $table->string('scheduleStart');
            $table->string('scheduleEnd');
            $table->integer('owner_id')->unsigned();
            $table->string('addressActive');
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salons');
    }
};
