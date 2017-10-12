<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use DB;

abstract class EntityBase extends Model
{
    protected $mapping = [];

    public function storable(){
        return [];
    }
}