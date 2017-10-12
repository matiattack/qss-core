<?php namespace App\Http\Controllers;

use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use App\Repositories\Categorias\Categoria;
use App\Repositories\Disciplinas\Disciplina;
use App\Repositories\PublicacionUsuario\PublicacionUsuarioEntity;
use App\Repositories\Usuarios\Usuario;
use App\Repositories\UsuariosDisciplinas\UsuarioDisciplina;

use Illuminate\Http\Request;
use JWTAuth;

class DisciplineController extends RestController
{
    private $discipline;
    private $category;
    private $userDiscipline;
    private $user;

    public function __construct(Disciplina $disciplina, Categoria $categoria, UsuarioDisciplina $usuarioDisciplina, Usuario $usuario)
    {
        $this->discipline = $disciplina;
        $this->category = $categoria;
        $this->userDiscipline = $usuarioDisciplina;
        $this->user = $usuario;

        $this->settings('show',['with' => ['siguiendo.usuario']]);
    }

    function getRepository()
    {
        return $this->discipline;
    }

    public function follow($id, Request $request)
    {

        if(!$request->has('action')){
            return response()->json(ControllerResponses::unprocesableResp());
        }

        if (! $authUsu = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        if(! $disicipline = $this->discipline->byId($id)){
            return response()->json(ControllerResponses::notFoundResp());
        }

        $sigue = $this->userDiscipline->byParameters(['id_usuario', 'id_disciplina'], '=', [$authUsu->id, $disicipline->id])->first();

        if(!$sigue && !$request->input('action')){
            return response()->json(ControllerResponses::unprocesableResp());
        }else if(!$sigue && $request->input('action')){

            $data = [
                'id_usuario' => $authUsu->id,
                'id_disciplina' => $disicipline->id
            ];

            if(! $sigue = $this->userDiscipline->save($data)){
                return response()->json(ControllerResponses::unprocesableResp());
            }
        }else{
            if( ! $followStatus = $this->userDiscipline->save(['estado_registro_usuario_disciplina' => $request->input('action')], $sigue->id)){
                return response()->json(ControllerResponses::unprocesableResp());
            }
        }


        return response()->json(ControllerResponses::okResp([]));
    }

    public function categories()
    {
        $this->category->with('disciplinas');
        $data = $this->category->all();
        return response()->json(ControllerResponses::okResp($data));
    }

    public function publications($disciplineId)
    {

        $entity = new PublicacionUsuarioEntity();

        $posts = $entity
            ->with('usuario.imagen')
            ->with('reacciones.usuario')
            ->with('imagen')
            ->with('publicacionDisciplinas.disciplina')
            ->whereHas('publicacionDisciplinas', function ($q) use ($disciplineId){
            $q->where('id_disciplina', '=', $disciplineId);
        })->get();

        return response()->json(ControllerResponses::okResp($posts));

    }
}