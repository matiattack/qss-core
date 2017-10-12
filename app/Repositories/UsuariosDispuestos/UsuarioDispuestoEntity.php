<?php namespace App\Repositories\UsuariosDispuestos;


use App\Repositories\Base\EntityBase;

class UsuarioDispuestoEntity extends EntityBase
{

    protected $table = 'usuarios_dispuestos';
    protected $primaryKey = 'id_comentario';

    const CREATED_AT    =   'fecha_hora_registro_comentario';
    const UPDATED_AT    =   'fecha_hora_modificacion_comentario';

    protected $hidden = [
        'id_comentario',
        'texto_comentario',
        'id_usuario',
        'fecha_hora_registro_comentario',
        'fecha_hora_modificacion_comentario',
        'fecha_hora_inicio_usuario_dispuesto',
        'fecha_hora_fin_usuario_dispuesto',
        'id_grupo',
        'ajustar_horario_usuario_dispuesto'
    ];

    protected $fillable = [
        'id_comentario',
        'texto_comentario',
        'id_usuario',
        'fecha_hora_registro_comentario',
        'fecha_hora_modificacion_comentario',
        'fecha_hora_inicio_usuario_dispuesto',
        'fecha_hora_fin_usuario_dispuesto',
        'id_grupo',
        'ajustar_horario_usuario_dispuesto'
    ];

    protected $appends = ['id', 'texto', 'registro', 'modificacion', 'inicio', 'fin', 'ajustarHorario'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function grupo()
    {
        return $this->hasOne('App\Repositories\Grupos\GrupoEntity', 'id_grupo', 'id_grupo');
    }

    public function reacciones()
    {
        return $this->hasMany('App\Repositories\ReaccionesComentarios\ReaccionComentarioEntity', 'id_comentario', 'id_comentario');
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

    public function getInicioAttribute()
    {
        return $this->attributes['fecha_hora_inicio_usuario_dispuesto'];
    }

    public function getFinAttribute()
    {
        return $this->attributes['fecha_hora_fin_usuario_dispuesto'];
    }

    public function getAjustarHorarioAttribute()
    {
        return $this->attributes['ajustar_horario_usuario_dispuesto'];
    }
}