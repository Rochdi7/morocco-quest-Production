<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Single "all in one" table for every inbound signal from the public site:
 * tour inquiries, activity inquiries, contact/B2B forms, and WhatsApp/phone
 * clicks. One table (rather than one per source) so the admin can sort the
 * whole funnel by date in a single Filament list. `type` discriminates.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            // tour_inquiry | activity_inquiry | contact_inquiry
            // | whatsapp_click | phone_click
            $table->string('type', 40)->index();
            // Slug of the tour/activity, or page identifier for contact forms
            // and click events (e.g. 'dmc-marrakech').
            $table->string('source', 191)->nullable()->index();
            // new | contacted | converted | closed — manual pipeline status.
            $table->string('status', 20)->default('new')->index();

            // --- Contact details (null on click events) ---
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('nationality', 100)->nullable();

            // --- Trip details ---
            $table->date('arrival_date')->nullable();
            $table->string('duration_days', 50)->nullable();
            $table->unsignedSmallInteger('adults')->nullable();
            $table->unsignedSmallInteger('children')->nullable();
            $table->text('message')->nullable();

            // --- Related item (nullable: contact forms have no item) ---
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->foreignId('activity_id')->nullable()->constrained('activities')->nullOnDelete();
            $table->string('item_title')->nullable();

            // --- Visitor tracking ---
            $table->string('ip_address', 45)->nullable()->index();
            $table->string('browser', 60)->nullable();
            $table->string('platform', 60)->nullable();
            $table->string('device', 20)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('page_url')->nullable();
            $table->text('referrer')->nullable();

            $table->timestamps();

            $table->index(['type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
