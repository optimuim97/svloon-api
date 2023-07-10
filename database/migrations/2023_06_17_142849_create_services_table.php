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
        Schema::create('services', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('price');
            $table->boolean('isPromo')->nullable();
            $table->string('imageUrl')->nullable();
            $table->timestamps();
            $table->foreignId('service_type_id')->constrained()->nullable();
            $table->foreignId('salon_id')->constrained()->nullable();
        });
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
