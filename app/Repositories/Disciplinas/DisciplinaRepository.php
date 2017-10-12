<?php namespace App\Repositories\Disciplinas;


use App\Repositories\Base\RepositoryBase;

class DisciplinaRepository extends RepositoryBase implements Disciplina
{
    function getModel()
    {
        return new DisciplinaEntity();
    }

    function getQuery()
    {
        $model = new DisciplinaEntity();
        return $model->where('estado_registro_disciplina', '=', true);
    }

}