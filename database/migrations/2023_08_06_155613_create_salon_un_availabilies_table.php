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
        Schema::create('salon_un_availabilies', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('salon_id')->constrained();
            $table->date('date');
            $table->time('hour_start');
            $table->time('hour_end');
            $table->text('raison')->nullable();
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
        Schema::drop('salon_un_availabilies');
    }
};
