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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_title');
            $table->foreignId('orderer_id')->constrained('orderers');
            $table->string('order_no');
            $table->text('project_description')->nullable()->default('این فیلد اختیاریست. اگر توضیحی راجع به پروژه وجود دارد میتوانید در اینجا وارد نمایید');
            $table->string('project_manager');
            $table->string('start_date')->default('01-10-1399');
            $table->string('completed_at')->default('در حال انجام');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
