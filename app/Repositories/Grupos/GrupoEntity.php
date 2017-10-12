<?php namespace App\Repositories\Grupos;

use App\Repositories\Base\EntityBase;

class GrupoEntity extends EntityBase
{

    protected $table = 'grupos';
    protected $primaryKey = 'id_grupo';

    const CREATED_AT    =   'fecha_hora_registro_grupo';
    const UPDATED_AT    =   'fecha_hora_modificacion_grupo';

    protected $hidden = [
        'id_grupo',
        'nombre_grupo',
        'descripcion_grupo',
        'id_usuario',
        'fecha_hora_registro_grupo',
        'fecha_hora_modificacion_grupo',
        'estado_registro_grupo',
        'membresia_abierta_grupo',
        'capacidad_grupo',
        'cantidad_integrantes_grupo'
    ];

    protected $fillable = [
        'id_grupo',
        'nombre_grupo',
        'descripcion_grupo',
        'id_usuario',
        'fecha_hora_registro_grupo',
        'fecha_hora_modificacion_grupo',
        'estado_registro_grupo',
        'membresia_abierta_grupo',
        'capacidad_grupo'
    ];

    protected $appends = ['id', 'nombre', 'descripcion', 'membresia', 'capacidad', 'registro', 'modificacion'];

    public function creador()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function disciplinas()
    {
        return $this->hasMany('App\Repositories\GruposDisciplinas\GrupoDisciplinaEntity', 'id_grupo', 'id_grupo');
    }

    public function integrantes()
    {
        return $this->hasMany('App\Repositories\GruposUsuarios\GrupoUsuarioEntity', 'id_grupo', 'id_grupo')
            ->where('estado_registro_grupo_usuario', '=', true);
    }

    public function comentarios()
    {
        return $this->hasMany('App\Repositories\ComentariosGrupos\ComentarioGrupoEntity', 'id_grupo', 'id_grupo')
            ->where('estado_registro_comentario', '=', true);
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_grupo'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_grupo'];
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_grupo'];
    }

    public function getMembresiaAttribute()
    {
        return $this->attributes['membresia_abierta_grupo'];
    }

    public function getCapacidadAttribute()
    {
        return $this->attributes['capacidad_grupo'];
    }

    public function getCantIntegrantesAttribute()
    {
        return $this->attributes['cantidad_integrantes_grupo'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_grupo'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_grupo'];
    }

}