<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_lands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->decimal('soil_slope', 10, 2)->nullable();
            $table->string('soil_quality')->nullable();
            $table->boolean('is_wet_land')->default(false);
            $table->boolean('is_swampy')->default(false);
            $table->boolean('land_exit_for_animals')->default(false);
            $table->boolean('land_accommodation_for_animals')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_lands');
    }
};
