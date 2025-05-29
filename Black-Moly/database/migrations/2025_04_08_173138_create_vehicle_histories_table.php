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
        Schema::create('vehicle_histories', function (Blueprint $table) {
            $table->id();
            $table -> foreignId('vehicle_id')-> constrained('vehicles')-> onDelete('cascade');
            $table->integer('accidents')->default(0);
            $table->json('service_records')->nullable(); // JSON: maintenance/service history
            $table->integer('ownership_count')->default(1);
            $table->integer('actual_mileage')->nullable();
            $table->boolean('has_flood_damage')->default(false);
            $table->boolean('has_salvage_title')->default(false);
            $table->text('notes')->nullable();

            $table->timestamp('created_at')->useCurrent(); // No updated_at needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_histories');
    }
};
