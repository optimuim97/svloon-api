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
        Schema::create('salon_addresses', function (Blueprint $table) {
            $table->id('id');
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('address_name');
            $table->string('batiment_name')->nullable();
            $table->string('number_local')->nullable();
            $table->text('indications')->nullable();
            $table->string('bail')->nullable();
            $table->timestamps();
            $table->foreignId('salon_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salon_addresses');
    }
};
