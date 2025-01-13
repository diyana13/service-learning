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
        Schema::create('rubrics_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rubric_id')->constrained('rubrics', 'id')->cascadeOnDelete();
            $table->string('criteria_bm');
            $table->string('criteria_bi');
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubrics_criterias');
    }
};
