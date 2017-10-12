<?php namespace App\Repositories\Reacciones;

use App\Repositories\Base\EntityBase;

class ReaccionEntity extends EntityBase
{
    protected $table = 'reacciones';
    protected $primaryKey = 'id_reaccion';

    const CREATED_AT    =   'fecha_hora_registro_reaccion';
    const UPDATED_AT    =   'fecha_hora_modificacion_reaccion';

    protected $hidden = [
        'id_reaccion',
        'id_usuario',
        'id_difusion',
        'tipo_reaccion',
        'estado_registro_reaccion_comentario',
        'fecha_hora_registro_reaccion',
        'fecha_hora_modificacion_reaccion'
    ];

    protected $fillable = [
        'id_reaccion',
        'id_usuario',
        'id_difusion',
        'tipo_reaccion',
        'estado_registro_reaccion_comentario',
        'fecha_hora_registro_reaccion',
        'fecha_hora_modificacion_reaccion'
    ];

    protected $appends = ['id', 'tipo', 'registro', 'modificacion'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_reaccion'];
    }

    public function getTipoAttribute()
    {
        return $this->attributes['tipo_reaccion'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_reaccion'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_reaccion'];
    }
}