<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Iglesia extends Model
{
	protected $table = 'iglesias';

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
		'nombre',
		'icono',
		'direccion',
		'usuario_id',
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function grupos()
	{
		return $this->hasMany(Grupo::class);
	}

	public function personas()
	{
		return $this->hasMany(Persona::class);
	}
}
