<?php namespace App\Repositories\OfertasRecintos;

use App\Repositories\Base\EntityBase;

class OfertaRecintoEntity extends EntityBase
{
    protected $table = 'ofertas_recintos';
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
        'id_imagen_usuario',
        'condiciones_lunes_recinto',
        'condiciones_martes_recinto',
        'condiciones_miercoles_recinto',
        'condiciones_jueves_recinto',
        'condiciones_viernes_recinto',
        'condiciones_sabado_recinto',
        'condiciones_domingo_recinto'
    ];

    protected $fillable = [
        'id_oferta',
        'asunto_oferta',
        'descripcion_oferta',
        'id_usuario',
        'precio_oferta',
        'estado_registro_oferta',
        'id_institucion',
        'id_imagen_usuario',
        'condiciones_lunes_recinto',
        'condiciones_martes_recinto',
        'condiciones_miercoles_recinto',
        'condiciones_jueves_recinto',
        'condiciones_viernes_recinto',
        'condiciones_sabado_recinto',
        'condiciones_domingo_recinto'
    ];

    protected $appends = ['id', 'asunto', 'descripcion', 'precio', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];

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

    public function getLunesAttribute()
    {
        return $this->attributes['condiciones_lunes_recinto'];
    }

    public function getMartesAttribute()
    {
        return $this->attributes['condiciones_martes_recinto'];
    }

    public function getMiercolesAttribute()
    {
        return $this->attributes['condiciones_miercoles_recinto'];
    }

    public function getJuevesAttribute()
    {
        return $this->attributes['condiciones_jueves_recinto'];
    }

    public function getViernesAttribute()
    {
        return $this->attributes['condiciones_viernes_recinto'];
    }

    public function getSabadoAttribute()
    {
        return $this->attributes['condiciones_sabado_recinto'];
    }

    public function getDomingoAttribute()
    {
        return $this->attributes['condiciones_domingo_recinto'];
    }

}