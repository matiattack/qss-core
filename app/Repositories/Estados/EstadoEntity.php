<?php namespace App\Repositories\Estados;


use App\Repositories\Base\EntityBase;

class EstadoEntity extends EntityBase
{

    protected $table = 'estados';
    protected $primaryKey = 'id_estado';

    const CREATED_AT    =   'fecha_hora_registro_estado';
    const UPDATED_AT    =   'fecha_hora_modificacion_estado';

    protected $hidden = [
        'id_estado',
        'nombre_estado',
        'id_pais',
        'fecha_hora_registro_estado',
        'fecha_hora_modificacion_estado'
    ];

    protected $fillable = [
        'id_estado',
        'nombre_estado',
        'id_pais'
    ];

    protected $maps = [
        'id' => 'id_estado',
        'nombre' => 'nombre_estado',
        'idPais' => 'id_pais'
    ];

    protected $appends = ['id', 'nombre', 'idPais'];

    public function getIdAttribute()
    {
        return $this->attributes['id_estado'];
    }

    public function getNombreAttribute(){
        return $this->attributes['nombre_estado'];
    }

    public function getIdPaisAttribute(){
        return $this->attributes['id_pais'];
    }
}