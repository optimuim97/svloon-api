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
        Schema::table('salon_addresses', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salon_addresses', function (Blueprint $table) {
            $table->string('batiment_name')->nullable();
            $table->string('number_local')->nullable();
            $table->text('indications')->nullable();
            $table->string('bail')->nullable();
        });
    }
};
