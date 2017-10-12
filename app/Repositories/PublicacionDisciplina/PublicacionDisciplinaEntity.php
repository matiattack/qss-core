<?php namespace App\Repositories\PublicacionDisciplina;

use App\Repositories\Base\EntityBase;

class PublicacionDisciplinaEntity extends EntityBase
{

    protected $table = 'publicaciones_disciplinas';
    protected $primaryKey = 'id_publicacion_disciplina';

    const CREATED_AT    =   'fecha_hora_registro_publicacion_disciplina';
    const UPDATED_AT    =   'fecha_hora_modificacion_publicacion_disciplina';

    protected $hidden = ['id_publicacion_disciplina', 'id_publicacion', 'id_disciplina', 'fecha_hora_registro_publicacion_disciplina', 'fecha_hora_modificacion_publicacion_disciplina'];

    protected $fillable = ['id_publicacion_disciplina', 'id_publicacion', 'id_disciplina', 'fecha_hora_registro_publicacion_disciplina', 'fecha_hora_modificacion_publicacion_disciplina'];

    protected $appends = ['id', 'registro', 'modificacion'];

    public function getIdAttribute()
    {
        return $this->attributes['id_publicacion_disciplina'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_publicacion_disciplina'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_publicacion_disciplina'];
    }

    public function publicacion()
    {
        return $this->hasOne('App\Repositories\PublicacionUsuario\PublicacionUsuarioEntity', 'id_difusion', 'id_publicacion');
    }

    public function disciplina()
    {
        return $this->hasOne('App\Repositories\Disciplinas\DisciplinaEntity', 'id_disciplina', 'id_disciplina');
    }

}