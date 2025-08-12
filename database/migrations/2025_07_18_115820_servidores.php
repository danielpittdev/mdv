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
		Schema::create('servidores', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid')->unique();
			$table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
			$table->foreignId('grupo_id')->constrained('grupos')->cascadeOnDelete();
			$table->string('rol')->nullable();   // opcional
			$table->timestamps();
			$table->unique(['persona_id', 'grupo_id']); // para que no se repita la relación
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('servidores');
	}
};
