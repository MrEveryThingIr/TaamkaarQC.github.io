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
        Schema::create('element_classes', function (Blueprint $table) {
            $table->id();
            $table->string('elementTag');
            $table->string('className')->unique();
            $table->string('purpose');
            $table->string('classString')->unique();
            $table->string('features');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_classes');
    }
};
