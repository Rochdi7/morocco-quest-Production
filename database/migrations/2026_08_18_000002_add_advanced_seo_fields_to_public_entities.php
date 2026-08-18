<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['tours', 'activities', 'blogs'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('canonical_url')->nullable()->after('meta_description');
                $table->string('og_title')->nullable()->after('canonical_url');
                $table->string('og_description')->nullable()->after('og_title');
                $table->string('og_image')->nullable()->after('og_description');
                $table->decimal('sitemap_priority', 2, 1)->nullable()->after('og_image');
                $table->string('sitemap_changefreq', 20)->nullable()->after('sitemap_priority');
            });
        }
    }

    public function down(): void
    {
        foreach (['tours', 'activities', 'blogs'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn([
                    'canonical_url',
                    'og_title',
                    'og_description',
                    'og_image',
                    'sitemap_priority',
                    'sitemap_changefreq',
                ]);
            });
        }
    }
};
