<?php namespace App\Repositories\Respuestas;


use App\Repositories\Base\EntityBase;

class RespuestaEntity extends EntityBase
{

    protected $table = 'respuestas';
    protected $primaryKey = 'id_difusion';

    const CREATED_AT    =   'fecha_hora_registro_difusion';
    const UPDATED_AT    =   'fecha_hora_modificacion_difusion';

    protected $hidden = [
        'id_difusion',
        'id_usuario',
        'texto_difusion',
        'id_comentario',
        'fecha_hora_registro_difusion',
        'fecha_hora_modificacion_difusion'
    ];

    protected $fillable = [
        'id_difusion',
        'id_usuario',
        'texto_difusion',
        'id_comentario',
        'fecha_hora_registro_difusion',
        'fecha_hora_modificacion_difusion'
    ];

    protected $appends = ['id', 'texto', 'registro', 'modificacion'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function comentario()
    {
        return $this->hasOne('App\Repositories\Comentarios\ComentarioEntity', 'id_difusion', 'id_comentario');
    }

    public function reacciones()
    {
        return $this->hasMany('App\Repositories\ReaccionesComentarios\ReaccionComentarioEntity', 'id_difusion', 'id_difusion');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_difusion'];
    }

    public function getTextoAttribute()
    {
        return $this->attributes['texto_difusion'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_difusion'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_difusion'];
    }

}