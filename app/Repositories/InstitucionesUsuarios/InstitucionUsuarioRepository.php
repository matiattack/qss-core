<?php namespace App\Repositories\InstitucionesUsuarios;

use App\Repositories\Base\RepositoryBase;

class InstitucionUsuarioRepository extends RepositoryBase implements InstitucionUsuario
{
    function getModel()
    {
        return new InstitucionUsuarioEntity();
    }

    function getQuery()
    {
        $model = new InstitucionUsuarioEntity();
        return $model->where('estado_registro_institucion_usuario', '=', true);
    }

}