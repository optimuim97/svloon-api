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
        Schema::create('artist_porfolios', function (Blueprint $table) {
            $table->id('id');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->string('imageUrl');
            $table->string('creator_name');
            $table->bigInteger('artist_id');
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
        Schema::drop('artist_porfolios');
    }
};
