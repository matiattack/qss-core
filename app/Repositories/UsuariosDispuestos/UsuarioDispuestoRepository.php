<?php namespace App\Repositories\UsuariosDispuestos;

use App\Repositories\Base\RepositoryBase;

class UsuarioDispuestoRepository extends RepositoryBase implements UsuarioDispuesto
{
    function getModel()
    {
        return new UsuarioDispuestoEntity();
    }

    function getQuery()
    {
        $model = new UsuarioDispuestoEntity();
        return $model->where('estado_registro_comentario', '=', true);
    }

}