<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('variante_imagen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variante_id');
            $table->string('imagen_url'); // ruta en storage
            $table->timestamps();

            $table->foreign('variante_id')->references('id')->on('variante')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variante_imagen');
    }
};
