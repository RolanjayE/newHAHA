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
        Schema::create('facilities_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id'); // Foreign key to facilities table
            $table->string('image_name');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities_images');
    }
};
