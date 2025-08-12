<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	protected $table = 'personas';

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
		'apellido_1',
		'apellido_2',
		'telefono',
		'correo',
		'avatar',
		'iglesia_id',
	];

	public function iglesia()
	{
		return $this->belongsTo(Iglesia::class);
	}

	public function servidores()
	{
		return $this->hasMany(Servidor::class);
	}

	public function grupos()
	{
		return $this->hasManyThrough(
			Grupo::class,
			Servidor::class,
			'persona_id',
			'id',
			'id',
			'grupo_id'
		);
	}

	public function seguimientos()
	{
		return $this->hasMany(Seguimiento::class)->orderBy('id', 'DESC');
	}
}
