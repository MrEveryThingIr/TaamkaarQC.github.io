<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualElementsTable extends Migration
{
    public function up()
    {
        Schema::create('actual_elements', function (Blueprint $table) {
            $table->id();
            $table->string('blade_directory');  // The directory within `resources/views`
            $table->string('blade_section');    // The specific section in the Blade file, e.g., `@section('content')`
            $table->foreignId('elementId')->constrained('html_elements')->onDelete('cascade');
            $table->foreignId('classId')->constrained('element_classes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actual_elements');
    }
}
