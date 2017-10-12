<?php namespace App\Repositories\ImagenesUsuarios;


use App\Repositories\Base\RepositoryBase;

class ImagenUsuarioRepository extends RepositoryBase implements ImagenUsuario
{
    function getModel()
    {
        return new ImagenUsuarioEntity();
    }

    function getQuery()
    {
        $model = new ImagenUsuarioEntity();
        return $model->where('estado_registro_imagen_usuario', '=', true);
    }

}