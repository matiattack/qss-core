<?php namespace App\Repositories\GruposDisciplinas;


use App\Repositories\Base\EntityBase;

class GrupoDisciplinaEntity extends EntityBase
{

    protected $table = 'grupos_disciplinas';
    protected $primaryKey = 'id_grupo_disciplina';

    const CREATED_AT    =   'fecha_hora_registro_grupo_disciplina';
    const UPDATED_AT    =   'fecha_hora_modificacion_grupo_disciplina';

    protected $hidden = [
        'id_grupo_disciplina',
        'id_grupo',
        'id_disciplina',
        'fecha_hora_registro_grupo_disciplina',
        'estado_registro_grupo_disciplina',
        'id_usuario_registro_grupo_disciplina',
        'fecha_hora_modificacion_grupo_disciplina'
    ];

    protected $fillable = [
        'id_grupo_disciplina',
        'id_grupo',
        'id_disciplina',
        'fecha_hora_registro_grupo_disciplina',
        'estado_registro_grupo_disciplina',
        'id_usuario_registro_grupo_disciplina'
    ];

    protected $appends = ['id', 'registro'];

    public function grupo()
    {
        return $this->hasOne('App\Repositories\Grupos\GrupoEntity', 'id_grupo', 'id_grupo');
    }

    public function disciplina()
    {
        return $this->hasOne('App\Repositories\Disciplinas\DisciplinaEntity', 'id_disciplina', 'id_disciplina');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_grupo_disciplina'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_grupo_disciplina'];
    }
}