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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('salon_id')->nullable();
            $table->string('label');
            $table->string('reference');
            $table->string('description');
            $table->string('address');
            $table->string('rating');
            $table->string('cover_image');
            $table->integer('nombre_places');
            $table->string('price');
            $table->string('duration');
            $table->string('status')->nullable();
            $table->boolean('is_active')->default();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
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
        Schema::drop('annonces');
    }
};
