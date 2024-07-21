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
        Schema::create('service_artists', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->string('time');
            $table->bigInteger('artist_id');
            $table->bigInteger('service_type_id');
            $table->bigInteger('service_place_type_id')->nullable();
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
        Schema::drop('service_artists');
    }
};
