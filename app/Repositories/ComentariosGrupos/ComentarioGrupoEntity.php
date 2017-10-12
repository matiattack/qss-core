<?php namespace App\Repositories\ComentariosGrupos;


use App\Repositories\Base\EntityBase;

class ComentarioGrupoEntity extends EntityBase
{

    protected $table = 'comentarios_grupos';
    protected $primaryKey = 'id_comentario';

    const CREATED_AT    =   'fecha_hora_registro_comentario';
    const UPDATED_AT    =   'fecha_hora_modificacion_comentario';

    protected $hidden = [
        'id_comentario',
        'texto_comentario',
        'id_usuario',
        'fecha_hora_registro_comentario',
        'fecha_hora_modificacion_comentario',
        'id_grupo'
    ];

    protected $fillable = [
        'id_comentario',
        'texto_comentario',
        'id_usuario',
        'fecha_hora_registro_comentario',
        'fecha_hora_modificacion_comentario',
        'id_grupo'
    ];

    protected $appends = ['id', 'texto', 'registro', 'modificacion'];

    public function grupo()
    {
        return $this->hasOne('App\Repositories\Grupos\GrupoEntity', 'id_grupo', 'id_grupo');
    }

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function respuestas()
    {
        return $this->hasMany('App\Repositories\Respuestas\RespuestaEntity', 'id_comentario', 'id_comentario');
    }

    public function reacciones()
    {
        return $this->hasMany('App\Repositories\Respuestas\ReaccionComentarioEntity', 'id_comentario', 'id_comentario');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_comentario'];
    }

    public function getTextoAttribute()
    {
        return $this->attributes['texto_comentario'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_comentario'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_comentario'];
    }

}