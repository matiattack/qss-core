<?php namespace App\Repositories\Ofertas;

use App\Repositories\Base\EntityBase;

class OfertaEntity extends EntityBase
{
    protected $table = 'ofertas';
    protected $primaryKey = 'id_oferta';

    const CREATED_AT    =   'fecha_hora_registro_oferta';
    const UPDATED_AT    =   'fecha_hora_modificacion_oferta';

    protected $hidden = [
        'id_oferta',
        'asunto_oferta',
        'descripcion_oferta',
        'id_usuario',
        'precio_oferta',
        'estado_registro_oferta',
        'id_institucion',
        'id_imagen_usuario'
    ];

    protected $fillable = [
        'id_oferta',
        'asunto_oferta',
        'descripcion_oferta',
        'id_usuario',
        'precio_oferta',
        'estado_registro_oferta',
        'id_institucion',
        'id_imagen_usuario'
    ];

    protected $appends = ['id', 'asunto', 'descripcion', 'precio'];

    public function imagen()
    {
        return $this->hasOne('App\Repositories\ImagenesUsuarios\ImagenUsuarioEntity', 'id_imagen_usuario', 'id_imagen_usuario');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_oferta'];
    }

    public function getAsuntoAttribute()
    {
        return $this->attributes['asunto_oferta'];
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_oferta'];
    }

    public function getPrecioAttribute()
    {
        return $this->attributes['precio_oferta'];
    }

}