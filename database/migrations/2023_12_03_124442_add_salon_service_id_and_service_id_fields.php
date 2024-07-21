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
        Schema::table('appointements', function (Blueprint $table) {
            $table->bigInteger("salon_service_id")->nullable();
            $table->bigInteger("service_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointements', function (Blueprint $table) {
            //
        });
    }
};
