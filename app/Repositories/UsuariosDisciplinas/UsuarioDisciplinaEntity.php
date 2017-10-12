<?php namespace App\Repositories\UsuariosDisciplinas;

use App\Repositories\Base\EntityBase;

class UsuarioDisciplinaEntity extends EntityBase
{

    protected $table = 'usuarios_disciplinas';
    protected $primaryKey = 'id_usuario_disciplina';

    const CREATED_AT    =   'fecha_hora_registro_usuario_disciplina';
    const UPDATED_AT    =   'fecha_hora_modificacion_usuario_disciplina';

    protected $hidden = [
        'id_usuario_disciplina',
        'id_disciplina',
        'id_usuario',
        'fecha_hora_registro_usuario_disciplina',
        'fecha_hora_modificacion_usuario_disciplina',
        'estado_registro_usuario_disciplina'
    ];

    protected $fillable = [
        'id_usuario_disciplina',
        'id_disciplina',
        'id_usuario',
        'fecha_hora_registro_usuario_disciplina',
        'fecha_hora_modificacion_usuario_disciplina',
        'estado_registro_usuario_disciplina'
    ];

    protected $appends = [
        'id',
        'registro',
        'modificacion'
    ];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function disciplina()
    {
        return $this->hasOne('App\Repositories\Disciplinas\DisciplinaEntity', 'id_disciplina', 'id_disciplina');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_usuario_disciplina'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_usuario_disciplina'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_usuario_disciplina'];
    }
}