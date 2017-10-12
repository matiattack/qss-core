<?php namespace App\Repositories\GruposUsuarios;


use App\Repositories\Base\RepositoryBase;

class GrupoUsuarioRepository extends RepositoryBase implements GrupoUsuario
{
    function getModel()
    {
        return new GrupoUsuarioEntity();
    }

    function getQuery()
    {
        $model = new GrupoUsuarioEntity();
        return $model->where('estado_registro_grupo_usuario', '=', true);
    }


}