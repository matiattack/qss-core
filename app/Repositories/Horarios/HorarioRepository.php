<?php namespace App\Repositories\Horarios;


use App\Repositories\Base\RepositoryBase;

class HorarioRepository extends RepositoryBase implements Horario
{
    function getModel()
    {
        return new HorarioEntity();
    }

    function getQuery()
    {
        $model = new HorarioEntity();
        return $model->where('estado_registro_horario', '=', true);
    }

}