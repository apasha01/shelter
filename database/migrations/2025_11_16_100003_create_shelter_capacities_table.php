<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_capacities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->decimal('healthy_area', 12, 2)->nullable();
            $table->decimal('open_area', 12, 2)->nullable();
            $table->decimal('emergency_indoor_capacity', 10, 2)->nullable();
            $table->decimal('emergency_outdoor_capacity', 10, 2)->nullable();
            $table->integer('number_of_people')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_capacities');
    }
};
