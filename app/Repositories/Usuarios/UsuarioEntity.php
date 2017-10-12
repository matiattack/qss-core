<?php namespace App\Repositories\Usuarios;

use App\Repositories\Base\EntityBase;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Hash;

class UsuarioEntity extends EntityBase implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    const CREATED_AT    =   'fecha_hora_registro_usuario';
    const UPDATED_AT    =   'fecha_hora_modificacion_usuario';

    protected $hidden = [
        'id_estado',
        'nombres_usuario',
        'apellidos_usuario',
        'correo_usuario',
        'nacimiento_usuario',
        'password',
        'descripcion_usuario',
        'sexo_usuario',
        'id_imagen_usuario',
        'fecha_hora_registro_usuario',
        'fecha_hora_modificacion_usuario',
        'id_estado'
    ];

    protected $fillable = [
        'id_usuario',
        'id_ciudad',
        'nombres_usuario',
        'apellidos_usuario',
        'correo_usuario',
        'nacimiento_usuario',
        'username',
        'password',
        'descripcion_usuario',
        'sexo_usuario',
        'id_imagen_usuario',
        'fecha_hora_registro_usuario',
        'fecha_hora_modificacion_usuario'
    ];

    protected $appends = [
        'id',
        'nombres',
        'apellidos',
        'correo',
        'nacimiento',
        'descripcion',
        'sexo',
        'imagenUsuario',
        'registro',
        'modificacion'
    ];

    public function siguiendo()
    {
        return $this->hasMany('App\Repositories\UsuariosSiguiendo\UsuarioSiguiendoEntity', 'id_usuario_usuario_siguiendo', 'id_usuario')
            ->where('estado_registro_usuario_siguiendo', '=', true);
    }

    public function siguen()
    {
        return $this->hasMany('App\Repositories\UsuariosSiguiendo\UsuarioSiguiendoEntity', 'id_usuario', 'id_usuario')
            ->where('estado_registro_usuario_siguiendo', '=', true);
    }

    public function imagen()
    {
        return $this->hasOne('App\Repositories\ImagenesUsuarios\ImagenUsuarioEntity', 'id_imagen_usuario', 'id_imagen_usuario');
    }

    public function disciplinas()
    {
        return $this->hasMany('App\Repositories\UsuariosDisciplinas\UsuarioDisciplinaEntity', 'id_usuario', 'id_usuario');
    }

    public function grupos()
    {
        return $this->hasMany('App\Repositories\GruposUsuarios\GrupoUsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function horarios()
    {
        return $this->hasMany('App\Repositories\Horarios\HorarioEntity', 'id_usuario', 'id_usuario')
            ->where('estado_registro_horario', '=', true);
    }

    public function ciudad()
    {
        return $this->hasOne('App\Repositories\Ciudad\CiudadEntity', 'id_ciudad', 'id_ciudad');
    }

    /*Appends Accessors*/

    public function getIdAttribute()
    {
        return $this->attributes['id_usuario'];
    }

    public function getEstadoAttribute()
    {
        return $this->attributes['id_estado'];
    }

    public function getNombresAttribute()
    {
        return $this->attributes['nombres_usuario'];
    }

    public function getApellidosAttribute()
    {
        return $this->attributes['apellidos_usuario'];
    }

    public function getCorreoAttribute()
    {
        return $this->attributes['correo_usuario'];
    }

    public function getNacimientoAttribute()
    {
        return $this->attributes['nacimiento_usuario'];
    }

    public function getUsernameAttribute()
    {
        return $this->attributes['username'];
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_usuario'];
    }

    public function getSexoAttribute()
    {
        return $this->attributes['sexo_usuario'];
    }

    public function getImagenUsuarioAttribute()
    {
        return $this->attributes['id_imagen_usuario'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_usuario'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_usuario'];
    }


}