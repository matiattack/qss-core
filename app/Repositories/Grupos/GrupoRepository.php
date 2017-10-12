<?php namespace App\Repositories\Grupos;

use App\Repositories\Base\RepositoryBase;

class GrupoRepository extends RepositoryBase implements Grupo
{
    function getModel()
    {
        return new GrupoEntity();
    }

    function getQuery()
    {
        $model = new GrupoEntity();
        return $model->where('estado_registro_grupo', '=', true);
    }

}