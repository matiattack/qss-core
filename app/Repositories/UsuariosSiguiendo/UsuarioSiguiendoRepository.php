<?php namespace App\Repositories\UsuariosSiguiendo;


use App\Repositories\Base\RepositoryBase;

class UsuarioSiguiendoRepository extends RepositoryBase implements UsuarioSiguiendo
{
    function getModel()
    {
        return new UsuarioSiguiendoEntity();
    }

    function getQuery()
    {
        $model = new UsuarioSiguiendoEntity();
        return $model->where('estado_registro_usuario_siguiendo', '=', true);

    }

}