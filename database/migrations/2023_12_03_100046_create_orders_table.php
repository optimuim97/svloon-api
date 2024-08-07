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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('appointement_id')->nullable();
            $table->bigInteger('salon_id')->nullable();
            $table->bigInteger('artist_id');
            $table->bigInteger('order_status_id');
            $table->text('details')->nullable();
            $table->text('instructions')->nullable();
            $table->text('total_price')->nullable();
            $table->datetime('date')->nullable();
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
        Schema::drop('orders');
    }
};
