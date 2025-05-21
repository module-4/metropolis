<?php

use App\Models\Component;
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
        Schema::create('component_blocklist', function (Blueprint $table) {
            $table->foreignIdFor(Component::class, 'component_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Component::class, 'blocked_component_id')->constrained()->cascadeOnDelete();
            $table->primary(['component_id', 'blocked_component_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_blocklist');
    }
};
