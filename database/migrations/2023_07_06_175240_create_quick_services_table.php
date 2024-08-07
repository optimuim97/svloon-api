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
            $table->foreignId('payment_method_id')->constrained()->nullable()->default(1);
            $table->foreignId('payment_type_id')->constrained()->nullable()->default(1);
            $table->string('address');
            $table->date('date')->nullable();
            $table->string('lat');
            $table->string('lon');
            $table->text('note')->nullable();
            $table->string('duration');
            $table->boolean('is_confirmed');
            $table->boolean('is_report')->nullable();
            $table->boolean('is_cancel')->nullable();
            $table->boolean('has_already_send_remeber')->default(0);
            $table->time('hour')->nullable();
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
