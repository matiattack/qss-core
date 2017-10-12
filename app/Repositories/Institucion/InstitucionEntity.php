<?php namespace App\Repositories\Institucion;


use App\Repositories\Base\EntityBase;

class InstitucionEntity extends EntityBase
{

    protected $table = 'instituciones';
    protected $primaryKey = 'id_institucion';

    const CREATED_AT    =   'fecha_hora_registro_institucion';
    const UPDATED_AT    =   'fecha_hora_modificacion_institucion';

    protected $hidden = [
        'id_institucion',
        'nombre_institucion',
        'id_usuario',
        'direccion_institucion',
        'fecha_hora_registro_institucion',
        'fecha_hora_modificacion_institucion',
        'estado_registro_institucion',
        'descripcion_institucion'
    ];

    protected $fillable = [
        'id_institucion',
        'nombre_institucion',
        'id_usuario',
        'id_ciudad',
        'direccion_institucion',
        'fecha_hora_registro_institucion',
        'fecha_hora_modificacion_institucion',
        'estado_registro_institucion',
        'latitud_institucion',
        'longitud_institucion',
        'descripcion_institucion'
    ];

    protected $appends = ['id', 'nombre', 'direccion', 'latitud', 'longitud', 'descripcion', 'registro', 'modificacion'];

    public function creador()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function imagen()
    {
        return $this->hasOne('App\Repositories\ImagenesUsuarios\ImagenUsuarioEntity', 'id_imagen_usuario', 'id_imagen_usuario');
    }

    public function ciudad()
    {
        return $this->hasOne('App\Repositories\Ciudad\CiudadEntity', 'id_ciudad', 'id_ciudad');
    }

    public function integrantes()
    {
        return $this->hasMany('App\Repositories\InstitucionesUsuarios\InstitucionUsuarioEntity', 'id_institucion', 'id_institucion');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_institucion'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_institucion'];
    }

    public function getDireccionAttribute()
    {
        return $this->attributes['direccion_institucion'];
    }

    public function getLatitudAttribute()
    {
        return $this->attributes['latitud_institucion'];
    }

    public function getLongitudAttribute()
    {
        return $this->attributes['longitud_institucion'];
    }

    public function getRegistroAttribute(){
        return $this->attributes['fecha_hora_registro_institucion'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_institucion'];
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_institucion'];
    }
}