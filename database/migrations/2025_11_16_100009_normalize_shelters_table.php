<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shelters', function (Blueprint $table) {
            // Drop old columns if they exist
            if (Schema::hasColumn('shelters', 'manager_mobile_1')) {
                $table->dropColumn(['manager_mobile_1', 'manager_mobile_2', 'manager_mobile_3']);
            }
            if (Schema::hasColumn('shelters', 'manager_vip_1')) {
                $table->dropColumn(['manager_vip_1', 'manager_vip_2', 'manager_vip_3']);
            }
            if (Schema::hasColumn('shelters', 'manager_phone_1')) {
                $table->dropColumn(['manager_phone_1', 'manager_phone_2', 'manager_phone_3']);
            }
            if (Schema::hasColumn('shelters', 'usage_types')) {
                $table->dropColumn(['usage_types', 'public_service_types', 'accessibility_features']);
            }
            if (Schema::hasColumn('shelters', 'distance_to_market')) {
                $table->dropColumn(['distance_to_market', 'distance_to_railway', 'distance_to_main_street', 'distance_to_highway']);
            }
            if (Schema::hasColumn('shelters', 'healthy_area')) {
                $table->dropColumn(['healthy_area', 'open_area', 'emergency_indoor_capacity', 'emergency_outdoor_capacity', 'number_of_people']);
            }
            if (Schema::hasColumn('shelters', 'has_permanent_shelter')) {
                $table->dropColumn([
                    'has_permanent_shelter', 'permanent_shelter_count', 'has_temporary_shelter', 'temporary_shelter_count',
                    'has_permanent_sanitation', 'permanent_sanitation_count', 'has_temporary_sanitation', 'temporary_sanitation_count',
                    'covered_healthy_area', 'covered_healthy_area_min', 'open_area_healthy', 'open_area_healthy_min', 'open_area_sum', 'tent_count'
                ]);
            }
            if (Schema::hasColumn('shelters', 'has_water_system')) {
                $table->dropColumn(['has_water_system', 'has_sewage_system', 'has_electricity_system', 'has_gas_system']);
            }
            if (Schema::hasColumn('shelters', 'has_sanitation_facilities')) {
                $table->dropColumn([
                    'has_sanitation_facilities', 'has_sports_facilities', 'has_children_welfare_facilities', 'has_women_welfare_facilities',
                    'has_sports_facilities_infrastructure', 'has_medical_equipment_storage'
                ]);
            }
            if (Schema::hasColumn('shelters', 'healthcare_service_count')) {
                $table->dropColumn([
                    'healthcare_service_count', 'healthcare_team_count', 'has_mobile_clinic', 'has_fixed_clinic',
                    'has_emergency_room', 'has_hospitalization', 'accessibility_to_construction', 'facilities_for_healthcare'
                ]);
            }
            if (Schema::hasColumn('shelters', 'soil_slope')) {
                $table->dropColumn(['soil_slope', 'soil_quality', 'is_wet_land', 'is_swampy', 'land_exit_for_animals', 'land_accommodation_for_animals']);
            }
            if (Schema::hasColumn('shelters', 'ownership_type')) {
                $table->dropColumn(['ownership_type', 'ownership_options', 'property_notes']);
            }

            // Add new columns if missing
            if (!Schema::hasColumn('shelters', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Not reversible due to data loss
    }
};
