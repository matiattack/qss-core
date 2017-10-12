<?php namespace App\Repositories\Categorias;


use App\Repositories\Base\RepositoryBase;

class CategoriaRepository extends RepositoryBase implements Categoria
{
    function getModel()
    {
        return new CategoriaEntity();
    }

    function getQuery()
    {
        $model = new CategoriaEntity();
        return $model->where('estado_registro_categoria', '=', true);
    }

}