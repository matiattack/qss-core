<?php namespace App\Repositories\Paises;

use App\Repositories\Base\RepositoryBase;

class PaisRepository extends RepositoryBase implements Pais
{
    function getModel()
    {
        return new PaisEntity();
    }

    function getQuery()
    {
        $model = new PaisEntity();
        return $model->where('estado_registro_pais', '=', true);
    }

}