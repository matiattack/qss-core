<?php namespace App\Repositories\Ofertas;


use App\Repositories\Base\RepositoryBase;

class OfertaRepository extends RepositoryBase implements Oferta
{

    function getModel()
    {
        return new OfertaEntity();
    }

    function getQuery()
    {
        $model = new OfertaEntity();
        return $model->where('estado_registro_oferta', '=', true);
    }
}