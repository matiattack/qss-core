<?php namespace App\Repositories\Estados;


use App\Repositories\Base\RepositoryBase;

class EstadoRepository extends RepositoryBase implements Estado
{
    function getModel()
    {
        return new EstadoEntity();
    }

    function getQuery()
    {
        $model = new EstadoEntity();
        return $model->where('estado_registro_estado', '=', true);
    }

}