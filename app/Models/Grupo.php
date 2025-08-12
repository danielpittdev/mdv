<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grupo extends Model
{
	protected $table = 'grupos';

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
		'descripcion',
		'icono',
		'usuario_id',
		'iglesia_id',
	];

	public function iglesia()
	{
		return $this->belongsTo(Iglesia::class);
	}

	public function servidores()
	{
		return $this->hasMany(Servidor::class)->orderBy('id', 'ASC');
	}

	public function personas()
	{
		return $this->hasManyThrough(
			Persona::class,
			Servidor::class,
			'grupo_id',
			'id',
			'id',
			'persona_id'
		);
	}
}
