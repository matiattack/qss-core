<?php namespace App\Repositories\UsuariosSiguiendo;

use App\Repositories\Base\EntityBase;

class UsuarioSiguiendoEntity extends EntityBase
{

    protected $table = 'usuarios_siguiendo';
    protected $primaryKey = 'id_usuario_siguiendo';

    const CREATED_AT    =   'fecha_hora_registro_usuario_siguiendo';
    const UPDATED_AT    =   'fecha_hora_modificacion_usuario_siguiendo';

    protected $hidden = [
        'id_usuario_siguiendo',
        'id_usuario',
        'id_usuario_usuario_siguiendo',
        'fecha_hora_registro_usuario_siguiendo',
        'fecha_hora_modificacion_usuario_siguiendo',
        'estado_registro_usuario_siguendo'
    ];

    protected $fillable = [
        'id_usuario_siguiendo',
        'id_usuario',
        'id_usuario_usuario_siguiendo',
        'fecha_hora_registro_usuario_siguiendo',
        'fecha_hora_modificacion_usuario_siguiendo',
        'estado_registro_usuario_siguiendo'
    ];

    protected $appends = [
        'id',
        'idUsuario',
        'registro',
        'modificacion'
    ];

    public function seguido()
    {
        return $this->belongsTo('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function seguidor()
    {
        return $this->belongsTo('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario_usuario_siguiendo', 'id_usuario');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_usuario_siguiendo'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_usuario_siguiendo'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_usuario_siguiendo'];
    }

    public function getIdUsuarioAttribute()
    {
        return $this->attributes['id_usuario'];
    }


}