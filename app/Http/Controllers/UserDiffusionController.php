<?php namespace App\Http\Controllers;

use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use App\Http\Helpers\ImageHelper;
use App\Repositories\Comentarios\Comentario;
use App\Repositories\Difusion\Difusion;
use App\Repositories\PublicacionDisciplina\PublicacionDisciplina;
use App\Repositories\PublicacionUsuario\PublicacionUsuario;
use App\Repositories\Reacciones\Reaccion;
use App\Repositories\Usuarios\Usuario;
use PhpSpec\Exception\Exception;
use Validator;
use Illuminate\Http\Request;
use JWTAuth;

class UserDiffusionController extends RestController
{
    private $diffusion;
    private $userDiffusion;
    private $user;
    private $reaction;
    private $comment;
    private $diffusionDiscipline;

    public function __construct(PublicacionUsuario $userDiffusion, Usuario $user, Reaccion $reaction, Comentario $comment, Difusion $difusion, PublicacionDisciplina $diffusionDiscipline)
    {
        $this->userDiffusion = $userDiffusion;
        $this->user = $user;
        $this->reaction = $reaction;
        $this->comment =  $comment;
        $this->diffusion = $difusion;
        $this->diffusionDiscipline = $diffusionDiscipline;

        $this->settings('show',['with' => [
            'usuario.imagen', 'reacciones.usuario', 'imagen', 'publicacionDisciplinas.disciplina'
        ]]);
    }

    function getRepository()
    {
        return $this->userDiffusion;
    }

    public function store(Request $request)
    {

        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $validation = $this->validateDiffusionRequest($request->all());

        if ($validation->fails()) {
            return response()->json(ControllerResponses::unprocesableResp($validation->errors()->all()));
        }

        if(! $user = $this->user->byId($request->input('user'))){
            return response()->json(ControllerResponses::notFoundResp());
        }

        $data = [
            'id_usuario' => $authUser->id,
            'id_usuario_publicacion' => $user->id,
            'texto_difusion' => $request->input('text')
        ];

        if($request->has('link') && $request->input('link') != null){
            $data = array_merge($data, $this->getLinkSaveData($request->input('link')));
        }

        if($request->has('image') && $request->input('image') != null){
            $data = array_merge($data, $this->getImageSaveData($request->input('image'), $authUser));
        }

        if(!$record = $this->userDiffusion->save($data)){
            return response()->json(ControllerResponses::unprocesableResp($validation->errors()->all()));
        }

        if($request->has('disciplines') && is_array($request->input('disciplines'))){
            foreach ($request->input('disciplines') as $discipline)
            {
                $this->diffusionDiscipline->save(['id_publicacion' => $record->id, 'id_disciplina' => $discipline]);
            }
        }

        return response()->json(ControllerResponses::okResp([]));
    }

    public function byUser($id)
    {
        $this->userDiffusion->with('usuario.imagen');
        $this->userDiffusion->with('reacciones.usuario');
        $this->userDiffusion->with('imagen');
        $this->userDiffusion->with('publicacionDisciplinas.disciplina');

        $diffusions = $this->userDiffusion->byParameters('id_usuario_publicacion', '=', $id);
        return response()->json(ControllerResponses::okResp($diffusions));
    }

    public function react($diffusion, $reaction)
    {
        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        if (!$diffusion =  $this->diffusion->byId($diffusion)){
            return response()->json(ControllerResponses::notFoundResp());
        }

        if(!$react = $this->reaction->byParameters(['id_usuario', 'id_difusion'], '=', [$authUser->id, $diffusion->id])->first()){

            $react = $this->reaction->save([
                'id_usuario' => $authUser->id,
                'id_difusion' => $diffusion->id,
                'tipo_reaccion' => $reaction
            ]);
        }else{
            $react->tipo_reaccion = $reaction;
            $react->save();
        }

        return response()->json(ControllerResponses::okResp($react));
    }

    public function comment($diffusion, Request $request)
    {
        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        if (!$diffusion =  $this->userDiffusion->byId($diffusion)){
            return response()->json(ControllerResponses::notFoundResp());
        }

        $validation = $this->validateCommentRequest($request->all());

        if ($validation->fails()) {
            return response()->json(ControllerResponses::unprocesableResp($validation->errors()->all()));
        }

        $data = [
            'id_usuario' => $authUser->id,
            'texto_difusion' => $request->input('text'),
            'id_publicacion' => $diffusion->id
        ];

        if(!$record = $this->comment->save($data)){
            return response()->json(ControllerResponses::unprocesableResp($validation->errors()->all()));
        }

        $record->load('usuario');
        return response()->json(ControllerResponses::okResp($record));
    }

    public function diffusionComments($diffusion)
    {
        $this->comment->with('usuario.imagen');
        $this->comment->with('usuario.imagen');
        $this->comment->with('reacciones.usuario');
        $comments = $this->comment->byParameters('id_publicacion', '=', $diffusion);
        return response()->json(ControllerResponses::okResp($comments));
    }

    public function validateUri(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'link' => 'active_url'
        ]);

        if($validation->fails()){
            return response()->json(ControllerResponses::unprocesableResp($validation->errors()->all()));
        }

        $metaData = $this->getUrlData($request->input('link'), true);
        $metaData['url'] = $request->input('link');
        return response()->json(ControllerResponses::okResp($metaData));
    }

    private function getImageSaveData($request, $user)
    {
        if(!is_array($request) || !array_key_exists('path', $request)){
            return [];
        }

        if(!$image = ImageHelper::createUserImage($request['path'], $user)){
            return [];
        }

        return ['id_imagen_usuario' => $image->id];
    }

    private function getLinkSaveData($request)
    {
        if(!is_array($request)){
            return [];
        }

        $keys = [
            'url' => 'url_enlace_publicacion',
            'description' => 'descripcion_enlace_publicacion',
            'image' => 'imagen_enlace_publicacion'
        ];

        $linkData = [];

        foreach ($keys as $key => $value) {
            if(array_key_exists($key, $request)){
                $linkData[$value] = $request[$key];
            }
        }

        return $linkData;
    }

    private function validateDiffusionRequest($request)
    {
        $validation = Validator::make($request, [
            'text' => 'required',
            'user' => 'required'
        ]);
        return $validation;
    }

    private function validateCommentRequest($request)
    {
        $validation = Validator::make($request, [
            'text' => 'required'
        ]);
        return $validation;
    }

    private function getUrlData($url, $raw=false) // $raw - enable for raw display
    {
        $result = false;

        $contents = $this->getUrlContents($url);

        if (isset($contents) && is_string($contents))
        {
            $title = null;
            $metaTags = null;
            $metaProperties = null;

            preg_match('/<title>([^>]*)<\/title>/si', $contents, $match );

            if (isset($match) && is_array($match) && count($match) > 0)
            {
                $title = strip_tags($match[1]);
            }

            preg_match_all('/<[\s]*meta[\s]*(name|property)="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $contents, $match);

            if (isset($match) && is_array($match) && count($match) == 4)
            {
                $originals = $match[0];
                $names = $match[2];
                $values = $match[3];

                if (count($originals) == count($names) && count($names) == count($values))
                {
                    $metaTags = array();
                    $metaProperties = $metaTags;
                    if ($raw) {
                        if (version_compare(PHP_VERSION, '5.4.0') == -1)
                            $flags = ENT_COMPAT;
                        else
                            $flags = ENT_COMPAT | ENT_HTML401;
                    }

                    for ($i=0, $limiti=count($names); $i < $limiti; $i++)
                    {
                        if ($match[1][$i] == 'name')
                            $meta_type = 'metaTags';
                        else
                            $meta_type = 'metaProperties';
                        if ($raw)
                            ${$meta_type}[$names[$i]] = array (
                                'html' => htmlentities($originals[$i], $flags, 'UTF-8'),
                                'value' => $values[$i]
                            );
                        else
                            ${$meta_type}[$names[$i]] = array (
                                'html' => $originals[$i],
                                'value' => $values[$i]
                            );
                    }
                }
            }

            $result = array (
                'title' => $title,
                'metaTags' => $metaTags,
                'metaProperties' => $metaProperties,
            );
        }

        return $result;
    }

    private function getUrlContents($url, $maximumRedirections = null, $currentRedirection = 0)
    {
        $result = false;

        $contents = @file_get_contents($url);

        // Check if we need to go somewhere else

        if (isset($contents) && is_string($contents))
        {
            preg_match_all('/<[\s]*meta[\s]*http-equiv="?REFRESH"?' . '[\s]*content="?[0-9]*;[\s]*URL[\s]*=[\s]*([^>"]*)"?' . '[\s]*[\/]?[\s]*>/si', $contents, $match);

            if (isset($match) && is_array($match) && count($match) == 2 && count($match[1]) == 1)
            {
                if (!isset($maximumRedirections) || $currentRedirection < $maximumRedirections)
                {
                    return $this->getUrlContents($match[1][0], $maximumRedirections, ++$currentRedirection);
                }

                $result = false;
            }
            else
            {
                $result = $contents;
            }
        }

        return $contents;
    }
}