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
        Schema::create('salon_schedules', function (Blueprint $table) {
            $table->id('id');
            $table->timestamp('start_day');
            $table->timestamp('end_dat');
            $table->timestamp('start_hour');
            $table->timestamp('end_hour');
            $table->timestamp('pause_start');
            $table->timestamp('pause_end');
            $table->boolean('is_active');
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
        Schema::drop('salon_schedules');
    }
};
