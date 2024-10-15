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
        Schema::create('venture_capitals', function (Blueprint $table) {
            $table->id();
            $table->string('vc_image');
            $table->string('vc_name');
            $table->string('subtitle')->nullable();
            $table->string('vc_description')->nullable();
            $table->string('vc_category');
            $table->string('vc_url');
            $table->integer('team_member');
            $table->year('founded_year');
            $table->integer('portfolio_count');
            $table->integer('portfolio_sector');
            $table->integer('portfolio_location');
            $table->integer('portfolio_unicorns');
            $table->integer('deals_12_month');
            $table->enum('status', ['VC', 'AN', 'SFO', 'PDF', 'SIF']);
            $table->boolean('is_seed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venture_capitals');
    }
};
