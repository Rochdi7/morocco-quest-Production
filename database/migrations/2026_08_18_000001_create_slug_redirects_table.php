<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slug_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_path')->unique();
            $table->string('new_path');
            $table->string('redirectable_type')->nullable();
            $table->unsignedBigInteger('redirectable_id')->nullable();
            $table->timestamps();

            $table->index(['redirectable_type', 'redirectable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slug_redirects');
    }
};
