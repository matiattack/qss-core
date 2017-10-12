<?php namespace App\Repositories\Comentarios;


use App\Repositories\Base\RepositoryBase;

class ComentarioRepository extends RepositoryBase implements Comentario
{
    function getModel()
    {
        return new ComentarioEntity();
    }

    function getQuery()
    {
        $model = new ComentarioEntity();
        return $model->where('estado_registro_difusion', '=', true);
    }

}