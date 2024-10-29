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
        Schema::create('sample_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained('part_samples')->onDelete('cascade');
            $table->foreignId('dimension_id')->constrained('dimensions')->onDelete('cascade');
            $table->float('operator_measurement');
            $table->float('Inspector_measurement');
            $table->float('other_measurement');
            $table->string('measurement_tool');
            $table->boolean('accept_orNot');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_measurements');
    }
};
