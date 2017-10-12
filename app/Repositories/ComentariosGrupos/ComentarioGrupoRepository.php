<?php namespace App\Repositories\ComentariosGrupos;


use App\Repositories\Base\RepositoryBase;

class ComentarioGrupoRepository extends RepositoryBase implements ComentarioGrupo
{
    function getModel()
    {
        return new ComentarioGrupoEntity();
    }

    function getQuery()
    {
        $model = new ComentarioGrupoEntity();
        return $model->where('estado_registro_comentario', '=', true);
    }

}