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
        Schema::create('dimensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drawing_part_id')->constrained('drawing_parts')->onDelete('cascade');
            $table->string('tag');
            $table->string('viewOrSection');
            $table->float('nominal_size');
            $table->string('UpperTolerance');
            $table->string('LowerTolerance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dimensions');
    }
};
