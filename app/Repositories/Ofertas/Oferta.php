<?php namespace App\Repositories\Ofertas;


interface Oferta
{
    public function with($relationship);
    public function all($orderBy = array());
    public function byId($id);
    public function byParameters($parameter, $compare, $value, $orderBy = array());
    public function save($data, $id = null);
}