<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bout_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('winner_id')
                ->nullable()
                ->constrained('wrestlers')
                ->nullOnDelete();

            $table->string('finish_type')->nullable();
            $table->string('duration')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
