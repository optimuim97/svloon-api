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
            $table->string('email')->unique();
            $table->string('owner_fullname')->nullable();
            $table->string('dialCode')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('scheduleStart');
            $table->timestamp('scheduleEnd');
            $table->string('scheduleStr');
            $table->string('city');
            $table->string('phoneNumber');
            $table->string('phone')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('localNumber')->nullable();
            $table->text('bailDocument');
            $table->bigInteger('salon_type_id')->unsigned();
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
