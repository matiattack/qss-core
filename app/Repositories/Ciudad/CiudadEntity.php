<?php namespace App\Repositories\Ciudad;


use App\Repositories\Base\EntityBase;

class CiudadEntity extends EntityBase
{
    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';

    const CREATED_AT    =   'fecha_hora_registro_ciudad';
    const UPDATED_AT    =   'fecha_hora_modificacion_ciudad';

    protected $hidden = [
        'id_ciudad',
        'id_estado',
        'nombre_ciudad',
        'fecha_hora_registro_ciudad',
        'fecha_hora_modificacion_ciudad'
    ];

    protected $fillable = [
        'id_ciudad',
        'id_estado',
        'nombre_ciudad',
        'fecha_hora_registro_ciudad',
        'fecha_hora_modificacion_ciudad'
    ];

    protected $appends = ['id', 'nombre', 'registro', 'modificacion'];

    public function getIdAttribute()
    {
        return $this->attributes['id_ciudad'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_ciudad'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_ciudad'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_ciudad'];
    }

}