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
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id('id');
            $table->string('fullname')->nullable();
            $table->string('imageUrl')->nullable();
            $table->string('fonction')->nullable();
            $table->foreignId('salon_id')->constrained();
            $table->foreignId('artist_id')->constrained();
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
        Schema::drop('staff_members');
    }
};
