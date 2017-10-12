<?php namespace App\Repositories\Respuestas;


use App\Repositories\Base\RepositoryBase;

class RespuestaRepository extends RepositoryBase implements Respuesta
{
    function getModel()
    {
        return new RespuestaEntity();
    }

    function getQuery()
    {
        $model = new RespuestaEntity();
        return $model->where('estado_registro_difusion', '=', true);
    }

}