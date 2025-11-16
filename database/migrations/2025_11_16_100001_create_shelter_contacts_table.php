<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelter_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->string('manager_mobile_1')->nullable();
            $table->string('manager_mobile_2')->nullable();
            $table->string('manager_mobile_3')->nullable();
            $table->string('manager_vip_1')->nullable();
            $table->string('manager_vip_2')->nullable();
            $table->string('manager_vip_3')->nullable();
            $table->string('manager_phone_1')->nullable();
            $table->string('manager_phone_2')->nullable();
            $table->string('manager_phone_3')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_contacts');
    }
};
