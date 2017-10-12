<?php namespace App\Repositories\Reacciones;

use App\Repositories\Base\RepositoryBase;

class ReaccionRepository extends RepositoryBase implements Reaccion
{

    function getModel()
    {
        return new ReaccionEntity();
    }

    function getQuery()
    {
        $model = new ReaccionEntity();
        return $model->where('estado_registro_reaccion', '=', true);
    }

}