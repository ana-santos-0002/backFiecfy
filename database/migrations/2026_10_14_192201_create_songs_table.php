<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('album_id')
                ->constrained('albums')
                ->cascadeOnDelete();

            $table->string('title');
            $table->integer('duration_seconds');
            $table->integer('track_number')->default(1);
            $table->boolean('is_explicit')->default(false);
            $table->string('audio_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};