<?php namespace App\Repositories\Usuarios;

use App\Repositories\Base\RepositoryBase;

class UsuarioRepository extends RepositoryBase implements Usuario
{
    function getModel()
    {
        return new UsuarioEntity();
    }

    function getQuery()
    {
        $model = new UsuarioEntity();
        return $model->where('estado_registro_usuario', '=', true)->with('imagen');
    }
}