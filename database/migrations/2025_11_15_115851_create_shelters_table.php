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
Schema::create('shelters', function (Blueprint $table) {
    $table->id();

    $table->string('name'); 

    $table->foreignId('province_id')->constrained()->cascadeOnDelete();
    $table->foreignId('county_id')->constrained()->cascadeOnDelete();
    $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
    $table->string('village_name')->nullable(); 

    $table->string('address')->nullable(); 
    $table->decimal('latitude', 10, 7)->nullable();   
    $table->decimal('longitude', 10, 7)->nullable();

    $table->string('postal_code', 20)->nullable();
    $table->enum('shelter_type', ['emergency', 'temporary_site'])->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
