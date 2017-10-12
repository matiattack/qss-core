<?php  namespace App\Repositories\PublicacionUsuario;


use App\Repositories\Base\RepositoryBase;

class PublicacionUsuarioRepository extends RepositoryBase implements PublicacionUsuario
{
    function getModel()
    {
        return new PublicacionUsuarioEntity();
    }

    function getQuery()
    {
        $model = new PublicacionUsuarioEntity();
        return $model->where('estado_registro_difusion', '=', true);
    }

}