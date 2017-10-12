<?php  namespace App\Repositories\Difusion;

use App\Repositories\Base\EntityBase;

class DifusionEntity extends EntityBase
{

    protected $table = 'difusion';
    protected $primaryKey = 'id_difusion';

    const CREATED_AT    =   'fecha_hora_registro_difusion';
    const UPDATED_AT    =   'fecha_hora_modificacion_difusion';

    protected $hidden = [
        'id_difusion',
        'id_usuario',
        'texto_difusion',
        'estado_registro_difusion',
        'fecha_hora_registro_difusion',
        'fecha_hora_modificacion_difusion'
    ];

    protected $fillable = [
        'id_difusion',
        'id_usuario',
        'texto_difusion',
        'estado_registro_difusion',
        'fecha_hora_registro_difusion',
        'fecha_hora_modificacion_difusion'
    ];

    protected $appends = ['id', 'texto'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function reacciones()
    {
        return $this->hasMany('App\Repositories\Reacciones\ReaccionEntity', 'id_difusion', 'id_difusion');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_difusion'];
    }

    public function getTextoAttribute()
    {
        return $this->attributes['texto_difusion'];

    }
}