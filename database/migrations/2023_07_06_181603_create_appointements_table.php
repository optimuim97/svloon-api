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
        Schema::create('appointements', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('creator_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('appointment_status_id')->nullable();
            $table->bigInteger('salon_service_id')->nullable();
            $table->date('date')->nullable();
            $table->timestamp('hour')->nullable();
            $table->string('date_time')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('is_confirmed');
            $table->boolean('is_report');
            $table->boolean('is_cancel');
            $table->date('report_date')->nullable();
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
        Schema::drop('appointements');
    }
};
