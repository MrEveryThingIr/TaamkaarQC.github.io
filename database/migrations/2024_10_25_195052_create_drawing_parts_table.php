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
        Schema::create('drawing_parts', function (Blueprint $table) {
            $table->id();
            $table->string('drawing_code')->unique();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('drawing_file')->unique();

            // Fields from the `parts` table
            $table->string('part_name');
            $table->string('part_number');
            $table->string('part_type');
            $table->string('part_material');
            $table->string('device');
            $table->text('part_description')->nullable()->default('این فیلد اختیاریست.');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drawing_parts');
    }
};
