<?php namespace App\Repositories\Calles;

use App\Repositories\Base\RepositoryBase;

class CalleRepository extends RepositoryBase implements Calle
{

    function getModel()
    {
        return new CalleEntity();
    }

    function getQuery()
    {
        $model = new CalleEntity();
        return $model->where('estado_registro_calle', '=', true);
    }
}