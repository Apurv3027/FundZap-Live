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
            $table->unsignedBigInteger('venture_capital_id'); // Foreign key
            $table->string('pf_startup_name');
            $table->string('pf_startup_image');
            $table->string('pf_startup_url');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('venture_capital_id')
                  ->references('id')
                  ->on('venture_capitals')
                  ->onDelete('cascade'); // Delete portfolio if related venture capital is deleted
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
