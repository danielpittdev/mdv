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
		Schema::create('seguimientos', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid')->unique();
			$table->string('titulo')->nullable();
			$table->text('descripcion');
			$table->string('estado_emocional');
			$table->date('fecha_recordar')->nullable();
			$table->string('prioridad')->nullable(); // o enum
			$table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
			$table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('seguimientos');
	}
};
