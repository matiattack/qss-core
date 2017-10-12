<?php namespace App\Repositories\UsuariosDisciplinas;

use App\Repositories\Base\RepositoryBase;

class UsuarioDisciplinaRepository extends RepositoryBase implements UsuarioDisciplina
{
    function getModel()
    {
        return new UsuarioDisciplinaEntity();
    }

    function getQuery()
    {
        $model = new UsuarioDisciplinaEntity();
        return $model->where('estado_registro_usuario_disciplina', '=', true);
    }

}