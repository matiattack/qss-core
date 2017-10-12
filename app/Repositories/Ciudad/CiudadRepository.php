<?php namespace App\Repositories\Ciudad;

use App\Repositories\Base\RepositoryBase;

class CiudadRepository extends RepositoryBase implements Ciudad
{
    function getModel()
    {
        return new CiudadEntity();
    }

    function getQuery()
    {
        $model = new CiudadEntity();
        return $model->where('estado_registro_ciudad', '=', true);
    }

}