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
        Schema::create('salon_services', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('price');
            // $table->string('imageUrl');
            $table->string('time');
            $table->bigInteger('salon_id')->unsigned();
            $table->bigInteger('service_type_id')->unsigned();
            $table->bigInteger('service_place_type_id')->unsigned();
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
        Schema::drop('salon_services');
    }
};
