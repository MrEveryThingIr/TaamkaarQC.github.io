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
        Schema::create('orderers', function (Blueprint $table) {
            $table->id();
            $table->string('orderer_name');
            $table->string('orderer_email')->nullable();
            $table->string('orderer_phone')->nullable();
            $table->string('orderer_brand')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderers');
    }
};
