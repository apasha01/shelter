<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->boolean('has_sanitation_facilities')->default(false);
            $table->boolean('has_sports_facilities')->default(false);
            $table->boolean('has_children_welfare_facilities')->default(false);
            $table->boolean('has_women_welfare_facilities')->default(false);
            $table->boolean('has_sports_facilities_infrastructure')->default(false);
            $table->boolean('has_medical_equipment_storage')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_facilities');
    }
};
