<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 *
 * @property $id
 * @property $user_id
 * @property $cedula
 * @property $apellidos
 * @property $nombres
 * @property $email
 * @property $telefono
 * @property $direccion
 * @property $ciudad
 * @property $fecha_nacimiento
 * @property $genero
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Persona extends Model
{
    
    static $rules = [
		'user_id' => 'required',
		'cedula' => 'required',
		'apellidos' => 'required',
		'nombres' => 'required',
		'email' => 'required',
		'telefono' => 'required',
		'direccion' => 'required',
		'ciudad' => 'required',
		'fecha_nacimiento' => 'required',
		'genero' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','cedula','apellidos','nombres','email','telefono','direccion','ciudad','fecha_nacimiento','genero'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
