<?php
/**
 * Created by PhpStorm.
 * User: maguirre
 * Date: 01-02-17
 * Time: 16:55
 */

namespace App\Repositories\Ciudad;


interface Ciudad
{
    public function with($relationship);
    public function all($orderBy = array());
    public function byId($id);
    public function byParameters($parameter, $compare, $value, $orderBy = array());
    public function save($data, $id = null);
}