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
		Schema::create('personas', function (Blueprint $table) {
			$table->id();
			$table->uuid('uuid')->unique();
			$table->string('nombre');
			$table->string('apellido_1');
			$table->string('apellido_2')->nullable();
			$table->string('telefono')->nullable();
			$table->string('correo')->nullable();
			$table->string('avatar')->nullable();
			$table->foreignId('iglesia_id')->constrained('iglesias')->cascadeOnDelete()->index();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('personas');
	}
};
