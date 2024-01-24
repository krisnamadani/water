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
        Schema::create('water_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('water_source_id')->constrained();
            $table->foreignId('water_status_id')->constrained();
            $table->double('water_ph');
            $table->double('water_temperature');
            $table->double('turbidity');
            $table->double('ambient_temperature');
            $table->double('ambient_humidity');
            $table->double('eligibility');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_data');
    }
};
