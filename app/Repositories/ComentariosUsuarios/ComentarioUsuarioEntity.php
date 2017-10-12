<?php namespace App\Repositories\ComentariosUsuarios;


use App\Repositories\Base\EntityBase;

class ComentarioUsuarioEntity extends EntityBase
{

    protected $table = 'comentarios_usuarios';
    protected $primaryKey = 'id_comentario';

    const CREATED_AT    =   'fecha_hora_registro_comentario';
    const UPDATED_AT    =   'fecha_hora_modificacion_comentario';

    protected $hidden = [
        'id_comentario',
        'texto_comentario',
        'id_usuario',
        'fecha_hora_registro_comentario',
        'fecha_hora_modificacion_comentario',
        'id_imagen_usuario',
        'link_comentario_usuario',
        'id_usuario_comentario_usuario',
        'titulo_link_comentario_usuario',
        'imagen_link_comentario_usuario',
        'descripcion_link_comentario_usuario',
        'video_url_link_comentario_usuario'
    ];

    protected $fillable = [
        'id_comentario',
        'texto_comentario',
        'id_usuario',
        'fecha_hora_registro_comentario',
        'fecha_hora_modificacion_comentario',
        'id_imagen_usuario',
        'link_comentario_usuario',
        'id_usuario_comentario_usuario',
        'titulo_link_comentario_usuario',
        'imagen_link_comentario_usuario',
        'descripcion_link_comentario_usuario',
        'video_url_link_comentario_usuario'
    ];

    protected $appends = ['id', 'texto', 'registro', 'modificacion', 'link', 'tituloLink', 'imagenLink', 'descripcionLink', 'videoUrlLink'];

    public function imagen()
    {
        return $this->hasOne('App\Repositories\ImagenesUsuarios\ImagenUsuarioEntity', 'id_imagen_usuario', 'id_imagen_usuario');
    }

    public function usuario()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario');
    }

    public function usuarioObjetivo()
    {
        return $this->hasOne('App\Repositories\Usuarios\UsuarioEntity', 'id_usuario', 'id_usuario_comentario_usuario');
    }

    public function respuestas()
    {
        return $this->hasMany('App\Repositories\Respuestas\RespuestaEntity', 'id_comentario', 'id_comentario');
    }

    public function reacciones()
    {
        return $this->hasMany('App\Repositories\ReaccionesComentarios\ReaccionComentarioEntity', 'id_comentario', 'id_comentario');
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_comentario'];
    }

    public function getTextoAttribute()
    {
        return $this->attributes['texto_comentario'];
    }

    public function getRegistroAttribute()
    {
        return $this->attributes['fecha_hora_registro_comentario'];
    }

    public function getModificacionAttribute()
    {
        return $this->attributes['fecha_hora_modificacion_comentario'];
    }

    public function getLinkAttribute()
    {
        return $this->attributes['link_comentario_usuario'];
    }

    public function getTituloLinkAttribute()
    {
        return $this->attributes['titulo_link_comentario_usuario'];
    }

    public function getImagenLinkAttribute()
    {
        return $this->attributes['imagen_link_comentario_usuario'];
    }

    public function getDescripcionLinkAttribute()
    {
        return $this->attributes['descripcion_link_comentario_usuario'];
    }

    public function getVideoUrlLinkAttribute()
    {
        return $this->attributes['video_url_link_comentario_usuario'];
    }
}