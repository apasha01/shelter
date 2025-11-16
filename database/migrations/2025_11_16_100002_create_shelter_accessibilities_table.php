<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_accessibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->json('usage_types')->nullable();
            $table->json('public_service_types')->nullable();
            $table->json('accessibility_features')->nullable();
            $table->decimal('distance_to_market', 10, 2)->nullable();
            $table->decimal('distance_to_railway', 10, 2)->nullable();
            $table->decimal('distance_to_main_street', 10, 2)->nullable();
            $table->decimal('distance_to_highway', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_accessibilities');
    }
};
