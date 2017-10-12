<?php namespace App\Repositories\Reacciones;


interface Reaccion
{
    public function with($relationship);
    public function all($orderBy = array());
    public function byId($id);
    public function byParameters($parameter, $compare, $value, $orderBy = array());
    public function save($data, $id = null);
}