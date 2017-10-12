<?php namespace App\Repositories\Base;

abstract class RepositoryBase
{
    private $aggregateRelations = [];

    abstract function getModel();

    abstract function getQuery();

    private function query()
    {
        $query  =   $this->getQuery();
        foreach($this->aggregateRelations as $relationship){
            $query->with($relationship);
        }
        return $query;
    }

    private function model()
    {
        return $this->getModel();
    }

    public function with($relationship)
    {
        $this->aggregateRelations[] = $relationship;
    }

    public function all($orderBy = array())
    {
        if(count($orderBy)==2)
            return $this->query()->orderBy($orderBy[0], $orderBy[1])->get();
        else
            return $this->query()->get();
    }

    public function byId($id)
    {
        return $this->query()->find($id);
    }

    public function byParameters($parameter, $compare, $value, $orderBy = array())
    {
        $query  =   $this->query();

        if(is_array($parameter)){
            for($i=0; $i<count($parameter); $i++){

                if(is_callable($parameter[$i])){
                    $query->where($parameter[$i]);
                }else{
                    $p  =   $parameter[$i];
                    $c  =   (is_array($compare))?$compare[$i]:$compare;
                    $v  =   (is_array($value))?$value[$i]:$value;

                    if(strtolower($c)=='in'){
                        $query->whereIn($p, $v);
                    }else if(strtolower($c)=='not in'){
                        $query->whereNotIn($p, $v);
                    }else if(strtolower($c)=='=' && strtolower($v)==null){
                        $query->whereNull($p);
                    }else if(strtolower($c)=='<>' && strtolower($v)==null){
                        $query->whereNotNull($p);
                    }else{
                        $isOr = strpos($p, 'OR ');
                        if($isOr === false){
                            $query->where($p, $c, $v);
                        }else{
                            $query->orWhere(str_replace('OR ', '', $p), $c, $v);
                        }
                    }
                }
            }
        }else{
            $query->where($parameter, $compare, $value);
        }

        if(count($orderBy)==2)
            return $query->orderBy($orderBy[0], $orderBy[1])->get();
        else
            return $query->get();
    }

    public function save($data, $id = null)
    {
        $object =   (object)$data;

        if(isset($id) && !is_null($id)){
            $model = $this->byId($id);
            if(!$model){
                return false;
            }
        }else{
            $model = $this->model();
        }

        $attributes = (object)$model->storable();

        foreach (get_object_vars($attributes) as $key => $value) {
            if(property_exists($object, $key)){
                $model->$key = (is_callable($value))?$value($object->$key):$object->$key;
            }else{
                $model->$key = (is_callable($value))?null:$attributes->$key;
            }
        }

        foreach (get_object_vars($object) as $key => $value) {
            if(!property_exists($attributes, $key)){
                $model->$key = $object->$key;
            }
        }

        if(!$model->save()){
            return false;
        }

        return $model;
    }

    public function saveRules(){ return []; }

    public function updateRules(){ return []; }

}
