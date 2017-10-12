<?php namespace App\Repositories\Horarios;

use App\Repositories\Base\EntityBase;

class HorarioEntity extends EntityBase
{
    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';

    const CREATED_AT    =   'fecha_hora_registro_horario';
    const UPDATED_AT    =   'fecha_hora_modificacion_horario';

    protected $hidden = [
        'id_horario',
        'id_usuario',
        'dia_horario',
        'inicio_horario',
        'termino_horario',
        'fecha_hora_registro_horario',
        'fecha_hora_modificacion_horario',
        'estado_registro_horario'
    ];

    protected $fillable = [
        'id_horario',
        'id_usuario',
        'dia_horario',
        'inicio_horario',
        'termino_horario',
        'fecha_hora_registro_horario',
        'fecha_hora_modificacion_horario',
        'estado_registro_horario'
    ];

    protected $appends = ['id', 'dia', 'inicio', 'termino', 'registro', 'modificacion'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_horario'];
    }

    public function getDiaAttribute()
    {
        return $this->attributes['dia_horario'];
    }

    public function getInicioAttribute()
    {
        return $this->attributes['inicio_horario'];
    }

    public function getTerminoAttribute()
    {
        return $this->attributes['termino_horario'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_horario'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_horario'];
    }
}