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
            $table->string('vc_name');
            $table->string('vc_category');
            $table->string('vc_image');
            $table->string('vc_description');
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
