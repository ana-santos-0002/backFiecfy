
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Criando a tabela de álbuns
        Schema::create('albums', function (Blueprint $table) {
            $table->id();

            // Relacionamento com o artista
            $table->foreignId('artist_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Informações do álbum
            $table->string('title');
            $table->integer('release_year');
            $table->string('cover_image')->nullable();

            // Data de criação e atualização
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Apaga a tabela se a migration for revertida
        Schema::dropIfExists('albums');
    }
};
