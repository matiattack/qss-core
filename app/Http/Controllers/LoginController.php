<?php namespace App\Http\Controllers;

use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use App\Repositories\Usuarios\Usuario;
use App\Repositories\Usuarios\UsuarioRepository;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private $repository;

    public function __construct(Usuario $usuario)
    {
        $this->middleware('cors');
        $this->middleware('jwt.auth', ['except' => ['login']]);
        $this->repository = $usuario;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json($request->all(), 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $tokenUser = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (JWTException $e) {
            return response()->json($e, 401);
        }

        $repository = new UsuarioRepository();
        $repository->with('siguiendo.seguido');
        $repository->with('siguen.seguidor');
        $repository->with('disciplinas.disciplina');
        //$repository->with('grupos.grupo');
        $repository->with('horarios');

        $user = $repository->byId($tokenUser->id_usuario);

        return response()->json(ControllerResponses::okResp($user));
    }
}