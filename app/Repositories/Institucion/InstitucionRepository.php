<?php namespace App\Repositories\Institucion;


use App\Repositories\Base\RepositoryBase;

class InstitucionRepository extends RepositoryBase implements Institucion
{

    function getModel()
    {
        return new InstitucionEntity();
    }

    function getQuery()
    {
        $model = new InstitucionEntity();
        return $model->where('estado_registro_institucion', '=', true);
    }
}