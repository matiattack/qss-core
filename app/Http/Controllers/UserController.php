<?php namespace App\Http\Controllers;

use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use App\Repositories\Usuarios\Usuario;
use App\Repositories\UsuariosSiguiendo\UsuarioSiguiendo;
use JWTAuth;
use Illuminate\Http\Request;
use Validator;
use Hash;

class UserController extends RestController
{
    private $user;
    private $siguiendo;


    public function __construct(Usuario $user, UsuarioSiguiendo $siguiendo)
    {
        $this->user = $user;
        $this->siguiendo = $siguiendo;
        $this->settings('show',['with' => [
            'imagen', 'horarios', 'disciplinas'
        ]]);
    }

    function getRepository()
    {
        return $this->user;
    }

    public function follow($id, Request $request)
    {

        if(!$request->has('action')){
            return response()->json(ControllerResponses::unprocesableResp());
        }

        if (! $authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        if(! $user = $this->user->byId($id)){
            return response()->json(ControllerResponses::notFoundResp());
        }

        $sigue = $this->siguiendo->byParameters(['id_usuario', 'id_usuario_usuario_siguiendo'], '=', [$user->id, $authUser->id])->first();

        if(!$sigue && !$request->input('action')){
            return response()->json(ControllerResponses::unprocesableResp());
        }else if(!$sigue && $request->input('action')){

            $data = [
                'id_usuario' => $user->id,
                'id_usuario_usuario_siguiendo' => $authUser->id
            ];

            if( ! $sigue = $this->siguiendo->save($data)){
                return response()->json(ControllerResponses::unprocesableResp());
            }
        }else{
            if( ! $unfollow = $this->siguiendo->save(['estado_registro_usuario_siguiendo' => $request->input('action')], $sigue->id)){
                return response()->json(ControllerResponses::unprocesableResp());
            }
        }
        return response()->json(ControllerResponses::okResp([]));

    }

    public function followings($id)
    {
        $this->user->with('siguiendo.seguido.imagen');
        if(! $user = $this->user->byId($id)){
            return response()->json(ControllerResponses::notFoundResp());
        }
        return response()->json(ControllerResponses::okResp($user));
    }

    public function followers($id)
    {
        $this->user->with('siguen.seguidor.imagen');
        if(! $user = $this->user->byId($id)){
            return response()->json(ControllerResponses::notFoundResp());
        }
        return response()->json(ControllerResponses::okResp($user));
    }

    public function update(Request $request, $id)
    {
        if (! $authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        if($authUser->id != $id){
            return response()->json(ControllerResponses::unprocesableResp());
        }

        $updateData = array();

        if($request->has('name') && trim($request->input('name')) != ''){
            $updateData['nombres_usuario'] = $request->input('name');
        }

        if($request->has('lastName') && trim($request->input('lastName')) != ''){
            $updateData['apellidos_usuario'] = $request->input('lastName');
        }

        if($request->has('email') && trim($request->input('email')) != ''){
            $updateData['correo_usuario'] = $request->input('email');
        }

        if($request->has('description') && trim($request->input('description')) != ''){
            $updateData['descripcion_usuario'] = $request->input('description');
        }

        if($request->has('username') && trim($request->input('username')) != ''){
            $updateData['username'] = $request->input('username');
        }

        if($request->has('password') && trim($request->input('password')) != ''){

            try {
                if (! $token = JWTAuth::attempt(['username' => $authUser->username, 'password' => $request->input('actual')])) {
                    return response()->json(ControllerResponses::unprocesableResp('Password is not valid'));
                }

                $updateData['password'] = Hash::make($request->input('password'));


            } catch (JWTException $e) {
                return response()->json(ControllerResponses::unprocesableResp('Error'));
            }
        }


        if(count($updateData) == 0){
            return response()->json(ControllerResponses::unprocesableResp());
        }

        $user = $this->user->save($updateData, $id);
        return response()->json(ControllerResponses::okResp($user));
    }
}