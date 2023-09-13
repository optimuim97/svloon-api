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
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('owner_fullname')->nullable();
            $table->string('dialCode')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('scheduleStart')->nullable();
            $table->timestamp('scheduleEnd')->nullable();
            $table->string('scheduleStr')->nullable();
            $table->string('city')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('phone')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('localNumber')->nullable();
            $table->text('bailDocument')->nullable();
            $table->bigInteger('salon_type_id')->unsigned()->nullable();
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
        Schema::drop('salons');
    }
};
