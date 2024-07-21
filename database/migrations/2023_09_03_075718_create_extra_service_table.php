<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('extra_service', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('extra_id');
            $table->unsignedBigInteger('service_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extra_service', function (Blueprint $table) {
            //
        });
    }
};
