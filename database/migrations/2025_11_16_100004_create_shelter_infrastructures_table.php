<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_infrastructures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->boolean('has_permanent_shelter')->default(false);
            $table->integer('permanent_shelter_count')->nullable();
            $table->boolean('has_temporary_shelter')->default(false);
            $table->integer('temporary_shelter_count')->nullable();
            $table->boolean('has_permanent_sanitation')->default(false);
            $table->integer('permanent_sanitation_count')->nullable();
            $table->boolean('has_temporary_sanitation')->default(false);
            $table->integer('temporary_sanitation_count')->nullable();
            $table->decimal('covered_healthy_area', 12, 2)->nullable();
            $table->decimal('covered_healthy_area_min', 12, 2)->nullable();
            $table->decimal('open_area_healthy', 12, 2)->nullable();
            $table->decimal('open_area_healthy_min', 12, 2)->nullable();
            $table->decimal('open_area_sum', 12, 2)->nullable();
            $table->integer('tent_count')->nullable();
            $table->boolean('has_water_system')->default(false);
            $table->boolean('has_sewage_system')->default(false);
            $table->boolean('has_electricity_system')->default(false);
            $table->boolean('has_gas_system')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_infrastructures');
    }
};
