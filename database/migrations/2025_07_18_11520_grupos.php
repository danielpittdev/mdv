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
		Schema::create('grupos', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid');
			$table->string('nombre');
			$table->string('descripcion');
			$table->string('icono')->nullable();
			// FK
			$table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');;
			$table->foreignId('iglesia_id')->constrained('iglesias')->onDelete('cascade');;
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		//
	}
};
