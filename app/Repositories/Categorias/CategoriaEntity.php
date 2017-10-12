<?php namespace App\Repositories\Categorias;


use App\Repositories\Base\EntityBase;

class CategoriaEntity extends EntityBase
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';

    const CREATED_AT    =   'fecha_hora_registro_categoria';
    const UPDATED_AT    =   'fecha_hora_modificacion_categoria';

    protected $hidden = [
        'id_categoria',
        'nombre_categoria',
        'fecha_hora_registro_categoria',
        'fecha_hora_modificacion_categoria',
        'estado_registro_categoria'
    ];

    protected $fillable = [
        'id_categoria',
        'nombre_categoria',
        'fecha_hora_registro_categoria',
        'fecha_hora_modificacion_categoria',
        'estado_registro_categoria'
    ];

    protected $appends = [
        'id', 'nombre', 'registro', 'modificacion'
    ];

    public function disciplinas()
    {
        return $this->hasMany('App\Repositories\Disciplinas\DisciplinaEntity', 'id_categoria', 'id_categoria');
    }

    /*Appends Accessors*/

    public function getIdAttribute()
    {
        return $this->attributes['id_categoria'];
    }

    public function getNombreAttribute()
    {
        return $this->attributes['nombre_categoria'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_categoria'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_categoria'];
    }

}