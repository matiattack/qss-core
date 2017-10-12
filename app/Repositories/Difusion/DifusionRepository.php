<?php namespace App\Repositories\Difusion;

use App\Repositories\Base\RepositoryBase;

class DifusionRepository extends RepositoryBase implements Difusion
{
    function getModel()
    {
        return new DifusionEntity();
    }

    function getQuery()
    {
        $model = new DifusionEntity();
        return $model->where('estado_registro_difusion', '=', true);
    }
}