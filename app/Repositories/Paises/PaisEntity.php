<?php namespace App\Repositories\Paises;

use App\Repositories\Base\EntityBase;

class PaisEntity extends EntityBase
{

    public static $snakeAttributes = false;

    protected $table = 'paises';
    protected $primaryKey = 'id_pais';

    const CREATED_AT    =   'fecha_hora_registro_pais';
    const UPDATED_AT    =   'fecha_hora_modificacion_pais';

    protected $hidden = ['id_pais', 'nombre_pais', 'fecha_hora_registro_pais', 'fecha_hora_modificacion_pais', 'estado_registro_pais'];

    protected $fillable = ['id_pais', 'nombre_pais', 'fecha_hora_registro_pais', 'fecha_hora_modificacion_pais'];

    protected $appends = ['id', 'nombre'];

    public function getIdAttribute()
    {
        return $this->attributes['id_pais'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_pais'];
    }

    public function estados()
    {
        return $this->hasMany('App\Repositories\Estados\EstadoEntity', 'id_pais', 'id_pais');
    }
}