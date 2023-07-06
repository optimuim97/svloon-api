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
        Schema::create('quick_services', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('service_id')->constrained()->nullable();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->string('address');
            $table->string('hour')->nullable();
            $table->string('lat');
            $table->string('lon');
            $table->string('duration');
            $table->boolean('is_confirmed');
            $table->boolean('is_report')->nullable();
            $table->boolean('is_cancel')->nullable();
            $table->boolean('has_already_send_remeber')->default(0);
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
        Schema::drop('quick_services');
    }
};
