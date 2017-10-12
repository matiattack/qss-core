<?php namespace App\Repositories\GruposDisciplinas;

use App\Repositories\Base\RepositoryBase;

class GrupoDisciplinaRepository extends RepositoryBase implements GrupoDisciplina
{
    function getModel()
    {
        return new GrupoDisciplinaEntity();
    }

    function getQuery()
    {
        $model = new GrupoDisciplinaEntity();
        return $model->where('estado_registro_grupo_disciplina', '=', true);
    }

}