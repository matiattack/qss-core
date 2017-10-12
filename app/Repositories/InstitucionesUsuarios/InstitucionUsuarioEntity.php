<?php namespace App\Repositories\InstitucionesUsuarios;

use App\Repositories\Base\EntityBase;

class InstitucionUsuarioEntity extends EntityBase
{
    protected $table = 'instituciones_usuarios';
    protected $primaryKey = 'id_institucion_usuario';

    const CREATED_AT    =   'fecha_hora_registro_institucion_usuario';
    const UPDATED_AT    =   'fecha_hora_modificacion_institucion_usuario';

    protected $hidden = [
        'id_institucion_usuario',
        'id_usuario',
        'id_institucion',
        'fecha_hora_registro_institucion_usuario',
        'fecha_hora_modificacion_institucion_usuario',
        'estado_registro_institucion_usuario',
        'administrador_institucion_usuario',
        'estado_relacion_institucion_usuario',
        'id_usuario_registro_institucion_usuario',
        'tipo_relacion_institucion_usuario',
    ];

    protected $fillable = [
        'id_institucion_usuario',
        'id_usuario',
        'id_institucion',
        'fecha_hora_registro_institucion_usuario',
        'fecha_hora_modificacion_institucion_usuario',
        'estado_registro_institucion_usuario',
        'administrador_institucion_usuario',
        'estado_relacion_institucion_usuario',
        'id_usuario_registro_institucion_usuario',
        'tipo_relacion_institucion_usuario',
    ];

    protected $appends = ['id', 'administrador', 'relacion', 'registro', 'modificacion'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function institucion()
    {
        return $this->hasOne('App\Repositories\Instituciones\InstitucionEntity', 'id_institucion', 'id_institucion');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_institucion_usuario'];
    }

    public function getAdministradorAttribute()
    {
        return $this->attributes['administrador_institucion_usuario'];
    }

    public function getRelacionAttribute()
    {
        return $this->attributes['tipo_relacion_institucion_usuario'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_institucion_usuario'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_institucion_usuario'];
    }
}