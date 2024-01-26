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
            $table->string('water_source');
            $table->double('water_ph');
            $table->double('water_temperature');
            $table->double('turbidity');
            $table->double('ambient_temperature');
            $table->double('ambient_humidity');
            $table->boolean('eligibility');
            $table->string('water_status');
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
