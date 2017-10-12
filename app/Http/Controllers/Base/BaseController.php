<?php namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Repositories\Base\RepositoryBase;
use Validator;

abstract class BaseController extends Controller
{

    abstract function getRepository();

    public function index()
    {
        $repository = $this->repository();
        return $this->onIndex(
            ControllerResponses::okResp($repository->all())
        );
    }

    public function show($id)
    {
        $repository = $this->repository();
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
        $repository = $this->repository();

        $data = $this->updateDataFormat($request->all());

        if(array_key_exists('_method', $data))
        {
            unset($data['_method']);
        }
        if(array_key_exists('_token', $data))
        {
            unset($data['_token']);
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

        $this->afterUpdate($entity);
        return $this->onUpdate(
            ControllerResponses::createdResp($entity)
        );

    }

    public function store(Request $request)
    {

        $repository = $this->repository();

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

        $this->afterStore($entity);

        return $this->onCreate(
            ControllerResponses::createdResp($entity)
        );
    }

    private function repository()
    {
        $repository = $this->getRepository();
        if($repository instanceof RepositoryBase){
            return $repository;
        }else{
            abort(505, 'getRepository method in abstract class BaseController must return a RepositoryBase Instance, ' . get_class($repository) . ' given.');
        }
    }

    public function onIndex($response){return $response;}
    public function onShow($response){return $response;}
    public function onUpdate($response){return $response;}
    public function onCreate($response){return $response;}

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

    public function afterStore($entity)
    {
        return true;
    }

    public function afterUpdate($entity)
    {
        return true;
    }

}