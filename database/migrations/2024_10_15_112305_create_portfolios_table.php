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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venture_capital_id')->constrained()->onDelete('cascade');
            $table->string('pf_startup_image')->nullable();
            $table->string('pf_startup_name');
            $table->string('subtitle')->nullable();
            $table->string('pf_startup_url');
            $table->year('founded_year');
            $table->string('funding');
            $table->string('location');
            $table->string('investor');
            $table->string('stage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
