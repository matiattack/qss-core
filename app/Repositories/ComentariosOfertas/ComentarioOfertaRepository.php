<?php namespace App\Repositories\ComentariosOfertas;


use App\Repositories\Base\RepositoryBase;

class ComentarioOfertaRepository extends RepositoryBase implements ComentarioOferta
{
    function getModel()
    {
        return new ComentarioOfertaEntity();
    }

    function getQuery()
    {
        $model = new ComentarioOfertaEntity();
        return $model->where('estado_registro_comentario', '=', true);
    }

}