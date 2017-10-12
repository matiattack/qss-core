<?php namespace App\Repositories\PublicacionDisciplina;


use App\Repositories\Base\RepositoryBase;

class PublicacionDisciplinaRepository extends RepositoryBase  implements PublicacionDisciplina
{
    function getModel()
    {
        return new PublicacionDisciplinaEntity();
    }

    function getQuery()
    {
        $model = new PublicacionDisciplinaEntity();
        return $model->where('estado_registro_publicacion_disciplina', '=', true);
    }
}