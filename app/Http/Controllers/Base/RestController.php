<?php namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Base\RepositoryBase;
use Validator;

abstract class RestController extends Controller
{
    private $settings = [];

    public function settings($method, array $options = []){
        $this->settings[$method] = $options;
    }

    abstract function getRepository();

    public function index()
    {
        $repository = $this->repository('index');
        return $this->onIndex(
            ControllerResponses::okResp($repository->all())
        );
    }

    public function show($id)
    {
        $repository = $this->repository('show');
        $enity = $repository->byId($id);

        if(!$enity){
            return $this->onShow(
                ControllerResponses::notFoundResp()
            );
        }

        return $this->onShow(
            ControllerResponses::okResp($enity)
        );
    }

    public function update(Request $request, $id)
    {

        $repository = $this->repository('update');

        $data = $this->updateDataFormat($request->all());

        if(array_key_exists('_method', $data))
        {
            unset($data['_method']);
        }
        if(array_key_exists('token', $data))
        {
            unset($data['token']);
        }


        $validation = Validator::make($data, $repository->updateRules());

        if($validation->fails())
        {
            return $this->onUpdate(
                ControllerResponses::unprocesableResp($validation->errors()->all())
            );
        }

        $entity = $repository->save($data, $id);

        if(!$entity)
        {
            return $this->onUpdate(
                ControllerResponses::unprocesableResp('Failed to update the resource')
            );
        }

        $entity = $this->afterUpdate($entity);
        return $this->onUpdate(
            ControllerResponses::createdResp($entity)
        );

    }

    public function store(Request $request)
    {

        $repository = $this->repository('store');

        $data = $this->createDataFormat($request->all());

        if(array_key_exists('_token', $data))
        {
            unset($data['_token']);
        }

        $validation = Validator::make($data, $repository->saveRules());

        if($validation->fails())
        {
            return $this->onCreate(
                ControllerResponses::unprocesableResp($validation->errors()->all())
            );
        }

        $entity = $repository->save($data);

        if(!$entity)
        {
            return $this->onCreate(
                ControllerResponses::unprocesableResp('Failed to create the resource')
            );
        }

        $this->afterStore($entity, $request->all());

        return $this->onCreate(
            ControllerResponses::createdResp($entity)
        );
    }

    private function repository($method = '')
    {
        $repository = $this->getRepository();
        if($repository instanceof RepositoryBase){

            if(trim($method)!=''){
                if(isset($this->settings[$method]['with'])){
                    if(is_array($this->settings[$method]['with'])){
                        foreach ($this->settings[$method]['with'] as $with){
                            $repository->with($with);
                        }
                    }else if(trim($this->settings[$method]['with'])!=''){
                        $repository->with($this->settings[$method]['with']);
                    }
                }
            }

            return $repository;
        }else{
            abort(505, 'getRepository method in abstract class BaseController must return a RepositoryBase Instance, ' . get_class($repository) . ' given.');
        }
    }

    public function onIndex($response){return response()->json($response);}
    public function onShow($response){return response()->json($response);}
    public function onUpdate($response){return response()->json($response);}
    public function onCreate($response){return response()->json($response);}

    public function createDataFormat($data)
    {
        if(array_key_exists('_token', $data))
        {
            unset($data['_token']);
        }
        return $data;
    }

    public function updateDataFormat($data)
    {
        if(array_key_exists('_token', $data))
        {
            unset($data['_token']);
        }

        if(array_key_exists('_method', $data))
        {
            unset($data['_method']);
        }
        return $data;
    }

    public function afterStore($entity, $request = [])
    {
        return true;
    }

    public function afterUpdate($entity)
    {
        return true;
    }

}