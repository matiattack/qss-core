<?php namespace App\Repositories\GruposUsuarios;


use App\Repositories\Base\EntityBase;

class GrupoUsuarioEntity extends EntityBase
{

    protected $table = 'grupos_usuarios';
    protected $primaryKey = 'id_grupo_usuario';

    const CREATED_AT    =   'fecha_hora_registro_grupo_usuario';
    const UPDATED_AT    =   'fecha_hora_modificacion_grupo_usuario';

    protected $hidden = [
        'id_grupo_usuario',
        'id_grupo',
        'id_usuario',
        'administrador_grupo',
        'fecha_hora_registro_grupo_usuario',
        'fecha_hora_modificacion_grupo_usuario',
        'estado_registro_grupo_usuario',
        'id_usuario_registro_grupo_usuario',
        'tipo_relacion_grupo_usuario'
    ];

    protected $fillable = [
        'id_grupo_usuario',
        'id_grupo',
        'id_usuario',
        'administrador_grupo',
        'fecha_hora_registro_grupo_usuario',
        'fecha_hora_modificacion_grupo_usuario',
        'estado_registro_grupo_usuario',
        'id_usuario_registro_grupo_usuario',
        'tipo_relacion_grupo_usuario'
    ];

    protected $appends = ['id', 'administrador', 'registro', 'relacion'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function grupo()
    {
        return $this->hasOne('App\Repositories\Grupos\GrupoEntity', 'id_grupo', 'id_grupo');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_grupo_usuario'];
    }

    public function getAdministradorAttribute()
    {
        return $this->attributes['administrador_grupo'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_grupo_usuario'];
    }

    public function getRelacionAttribute()
    {
        return $this->attributes['tipo_relacion_grupo_usuario'];
    }
}