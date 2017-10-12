<?php namespace App\Repositories\ImagenesUsuarios;


use App\Repositories\Base\EntityBase;

class ImagenUsuarioEntity extends EntityBase
{
    protected $table = 'imagenes_usuarios';
    protected $primaryKey = 'id_imagen_usuario';

    const CREATED_AT    =   'fecha_hora_registro_imagen_usuario';
    const UPDATED_AT    =   'fecha_hora_modificacion_imagen_usuario';

    protected $hidden = [
        'id_imagen_usuario',
        'id_usuario',
        'nombre_archivo_imagen_usuario',
        'fecha_hora_registro_imagen_usuario',
        'fecha_hora_modificacion_imagen_usuario'
    ];

    protected $fillable = [
        'id_imagen_usuario',
        'id_usuario',
        'nombre_archivo_imagen_usuario',
        'fecha_hora_registro_imagen_usuario',
        'fecha_hora_modificacion_imagen_usuario'
    ];

    protected $appends = ['id', 'path', 'registro', 'modificacion'];

    public function getIdAttribute()
    {
        return $this->attributes['id_imagen_usuario'];
    }

    public function getPathAttribute()
    {
        return $this->attributes['nombre_archivo_imagen_usuario'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_imagen_usuario'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_imagen_usuario'];
    }

}