<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_healthcares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->integer('healthcare_service_count')->nullable();
            $table->integer('healthcare_team_count')->nullable();
            $table->boolean('has_mobile_clinic')->default(false);
            $table->boolean('has_fixed_clinic')->default(false);
            $table->boolean('has_emergency_room')->default(false);
            $table->boolean('has_hospitalization')->default(false);
            $table->boolean('accessibility_to_construction')->default(false);
            $table->boolean('facilities_for_healthcare')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_healthcares');
    }
};
