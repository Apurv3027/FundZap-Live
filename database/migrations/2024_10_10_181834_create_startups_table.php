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
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('startup_image')->nullable();
            $table->string('startup_name');
            $table->year('year');
            $table->string('location');
            $table->string('total_funding');
            $table->string('latest_funding');
            $table->string('latest_investor');
            $table->integer('total_investor');
            $table->integer('funding_round');
            $table->string('post_money_valuation');
            $table->integer('employee_count');
            $table->text('startup_description');
            $table->string('startup_valuation');
            $table->string('startup_equity');
            $table->string('startup_view_count');
            $table->string('startup_url');
            $table->string('email');
            $table->string('phone_number');
            $table->date('first_covered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
