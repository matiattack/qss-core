<?php namespace App\Repositories\Calles;


use App\Repositories\Base\EntityBase;

class CalleEntity extends EntityBase
{

    protected $table = 'calles';
    protected $primaryKey = 'id_calle';

    const CREATED_AT    =   'fecha_hora_registro_calle';
    const UPDATED_AT    =   'fecha_hora_modificacion_calle';

    protected $hidden = [
        'id_calle',
        'id_ciudad',
        'id_usuario',
        'nombre_calle',
        'numero_calle',
        'latitud_calle',
        'longitud_calle',
        'fecha_hora_modificacion_calle',
        'fecha_hora_registro_calle',
        'estado_registro_calle'
    ];

    protected $fillable = [
        'id_calle',
        'id_ciudad',
        'id_usuario',
        'nombre_calle',
        'numero_calle',
        'latitud_calle',
        'longitud_calle',
        'fecha_hora_modificacion_calle',
        'fecha_hora_registro_calle',
        'estado_registro_calle'
    ];

    protected $appends = [
        'id', 'nombre', 'numero', 'latitud', 'longitud'
    ];

    public function ciudad()
    {
        return $this->hasOne('App\Repositories\Ciudad\CiudadEntity', 'id_ciudad', 'id_ciudad');
    }

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    /*Appends Accessors*/

    public function getIdAttribute()
    {
        return $this->attributes['id_calle'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_calle'];
    }

    public function getNumeroAttribute()
    {
        return $this->attributes['numero_calle'];
    }

    public function getLatitudAttribute()
    {
        return $this->attributes['latitud_calle'];
    }

    public function getLongitudAttribute()
    {
        return $this->attributes['longitud_calle'];
    }

}