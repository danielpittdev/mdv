<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
	protected $table = 'seguimientos';

	protected static function boot()
	{
		parent::boot();

		// Al crear un nuevo usuario, asigna un UUID si no tiene uno ya
		static::creating(function ($model) {
			if (empty($model->uuid)) {
				$model->uuid = (string) Str::uuid();
			}
		});
	}

	// Campos rellenables
	protected $fillable = [
		'titulo',
		'descripcion',
		'estado_emocional',
		'fecha_recordar',
		'prioridad',
		'usuario_id',
		'persona_id',
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
