<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
	protected $table = 'servidores';

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
		'grupo_id',
		'persona_id',
		'rol',
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function grupo()
	{
		return $this->belongsTo(Grupo::class);
	}
}
