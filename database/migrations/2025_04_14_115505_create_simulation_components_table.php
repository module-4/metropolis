<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simulation_components', function (Blueprint $table) {
            $table->foreignId('simulation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('component_id')->constrained()->cascadeOnDelete();
            $table->integer('x');
            $table->integer('y');
            $table->primary(['simulation_id', 'x', 'y']);
            $table->unique(['simulation_id', 'x', 'y']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_components');
    }
};
