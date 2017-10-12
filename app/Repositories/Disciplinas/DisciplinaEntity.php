<?php namespace App\Repositories\Disciplinas;


use App\Repositories\Base\EntityBase;

class DisciplinaEntity extends EntityBase
{
    protected $table = 'disciplinas';
    protected $primaryKey = 'id_disciplina';

    const CREATED_AT    =   'fecha_hora_registro_disciplina';
    const UPDATED_AT    =   'fecha_hora_modificacion_disciplina';

    protected $hidden = [
        'id_disciplina',
        'nombre_disciplina',
        'descripcion_disciplina',
        'id_categoria',
        'fecha_hora_registro_disciplina',
        'fecha_hora_modificacion_disciplina',
        'estado_registro_disciplina'
    ];

    protected $fillable = [
        'id_disciplina',
        'nombre_disciplina',
        'descripcion_disciplina',
        'id_categoria',
        'fecha_hora_registro_disciplina',
        'fecha_hora_modificacion_disciplina',
        'estado_registro_disciplina'
    ];

    protected $appends = [
        'id', 'nombre', 'descripcion', 'registro', 'modificacion'
    ];

    public function categoria()
    {
        return $this->hasOne('App\Repositories\Categorias\CategoriaEntity', 'id_categoria', 'id_categoria');
    }

    public function siguiendo()
    {
        return $this->hasMany('App\Repositories\UsuariosDisciplinas\UsuarioDisciplinaEntity', 'id_disciplina', 'id_disciplina');
    }

    /*Appends Accessors*/
    public function getIdAttribute()
    {
        return $this->attributes['id_disciplina'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_disciplina'];
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_disciplina'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_disciplina'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_disciplina'];
    }

}