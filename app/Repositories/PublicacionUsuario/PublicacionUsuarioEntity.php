<?php  namespace App\Repositories\PublicacionUsuario;


use App\Repositories\Base\EntityBase;

class PublicacionUsuarioEntity extends EntityBase
{

    protected $table = 'publicaciones_usuarios';
    protected $primaryKey = 'id_difusion';

    const CREATED_AT    =   'fecha_hora_registro_difusion';
    const UPDATED_AT    =   'fecha_hora_modificacion_difusion';

    protected $hidden = [
        'id_difusion',
        'id_usuario',
        'texto_difusion',
        'id_imagen_usuario',
        'id_usuario_publicacion',
        'titulo_enlace_publicacion',
        'url_enlace_publicacion',
        'descripcion_enlace_publicacion',
        'imagen_enlace_publicacion',
        'video_enlace_publicacion',
        'estado_registro_difusion',
        'fecha_hora_registro_difusion',
        'fecha_hora_modificacion_difusion'
    ];

    protected $fillable = [
        'id_difusion',
        'id_usuario',
        'texto_difusion',
        'id_usuario_publicacion',
        'fecha_hora_registro_difusion',
        'fecha_hora_modificacion_difusion'
    ];

    protected $appends = ['id', 'texto', 'tituloEnlace', 'urlEnlace', 'descripcionEnlace', 'imagenEnlace', 'videoEnlace', 'registro'];

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function usuarioPublicacion()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario_publicacion');
    }

    public function reacciones()
    {
        return $this->hasMany('App\Repositories\Reacciones\ReaccionEntity', 'id_difusion', 'id_difusion');
    }

    public function imagen()
    {
        return $this->hasOne('App\Repositories\ImagenesUsuarios\ImagenUsuarioEntity', 'id_imagen_usuario', 'id_imagen_usuario');
    }

    public function publicacionDisciplinas()
    {
        return $this->hasMany('App\Repositories\PublicacionDisciplina\PublicacionDisciplinaEntity', 'id_publicacion', 'id_difusion');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_difusion'];
    }

    public function getTextoAttribute()
    {
        return $this->attributes['texto_difusion'];
    }

    public function getTituloEnlaceAttribute()
    {
        return $this->attributes['titulo_enlace_publicacion'];
    }

    public function getUrlEnlaceAttribute()
    {
        return $this->attributes['url_enlace_publicacion'];
    }

    public function getDescripcionEnlaceAttribute()
    {
        return $this->attributes['descripcion_enlace_publicacion'];
    }

    public function getImagenEnlaceAttribute()
    {
        return $this->attributes['imagen_enlace_publicacion'];
    }

    public function getVideoEnlaceAttribute()
    {
        return $this->attributes['video_enlace_publicacion'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_difusion'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_difusion'];
    }

}