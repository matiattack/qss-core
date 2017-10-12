<?php namespace App\Repositories\ComentariosUsuarios;

use App\Repositories\Base\RepositoryBase;

class ComentarioUsuarioRepository extends RepositoryBase implements ComentarioUsuario
{
    function getModel()
    {
        return new ComentarioUsuarioEntity();
    }

    function getQuery()
    {
        $model = new ComentarioUsuarioEntity();
        return $model->where('estado_registro_comentario', '=', true);
    }

}