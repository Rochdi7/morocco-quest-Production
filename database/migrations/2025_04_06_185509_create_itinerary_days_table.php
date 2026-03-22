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
        Schema::create('itinerary_days', function (Blueprint $table) {
            $table->id(); // Standard auto-incrementing ID

            // Polymorphic relationship columns:
            // itineraryable_id will store the ID of the Tour, Trip, or Activity
            // itineraryable_type will store the Model class name (e.g., App\Models\Tour)
            $table->morphs('itineraryable'); // Creates both `itineraryable_id` and `itineraryable_type`

            $table->unsignedSmallInteger('day_number'); // Day sequence (e.g., 1, 2, 3)
            $table->string('title')->nullable();        // Title for the day (e.g., "Drive to Nayapul...")
            $table->text('description')->nullable();    // Detailed description for the day

            $table->timestamps(); // created_at and updated_at

            // Optional index for faster lookup/ordering
            $table->index('day_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_days');
    }
};
