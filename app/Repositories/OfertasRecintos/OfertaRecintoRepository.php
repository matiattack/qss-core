<?php namespace App\Repositories\OfertasRecintos;


use App\Repositories\Base\RepositoryBase;

class OfertaRecintoRepository extends RepositoryBase implements OfertaRecinto
{
    function getModel()
    {
        return new OfertaRecintoEntity();
    }

    function getQuery()
    {
        $model = new OfertaRecintoEntity();
        return $model->where('estado_registro_oferta', '=', true);
    }

}