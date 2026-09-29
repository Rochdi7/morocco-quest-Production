<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Moderation-by-default for blog comments.
 *
 * New comments are stored unapproved and only approved ones render publicly.
 * Existing rows also start unapproved: ~52 of the 60 live comments were spam
 * (audit 2026-09-28), so they are hidden — not deleted — until an admin
 * approves the genuine ones in Filament (Comments → filter "Pending" →
 * bulk "Approve"). Rolling back drops the column and restores the old
 * everything-visible behaviour.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->boolean('is_approved')->default(false)->after('content');
            $table->index(['blog_id', 'is_approved']);
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['blog_id', 'is_approved']);
            $table->dropColumn('is_approved');
        });
    }
};
