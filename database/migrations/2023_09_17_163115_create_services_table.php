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
        // Schema::create('services', function (Blueprint $table) {
        //     $table->id('id');
        //     $table->string('title');
        //     $table->string('slug');
        //     $table->text('description');
        //     $table->string('price');
        //     $table->boolean('isPromo');
        //     $table->string('imageUrl');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('services');
    }
};
