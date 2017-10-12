<?php namespace App\Http\Controllers;

use App\Repositories\ImagenesUsuarios\ImagenUsuario;
use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use App\Http\Helpers\ImageHelper;
use App\Repositories\Usuarios\Usuario;
use PhpSpec\Exception\Exception;
use Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;
use JWTAuth;

class ImageController extends RestController
{
    private $imagenUsuario;
    private $usuario;

    public function __construct(ImagenUsuario $imagenUsuario, Usuario $usuario)
    {
        $this->imagenUsuario = $imagenUsuario;
        $this->usuario = $usuario;
    }

    function getRepository()
    {
        return $this->imagenUsuario;
    }

    public function byUser($idUser)
    {
        $data = $this->imagenUsuario->byParameters('id_usuario', '=', $idUser);

        return response()->json(ControllerResponses::okResp($data));
    }

    public function setProfile(Request $request)
    {
        if (! $authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'path' => 'required'
        ]);

        if($validation->fails()){
            return response()->json(ControllerResponses::unprocesableResp($validation->errors()->all()));
        }

        $idImage = $request->input('id');

        if($idImage == 0){
            $pathImagen = $this->createImage($request->input('path'), strtolower($authUser->username));
            if($pathImagen === false){
                return response()->json(ControllerResponses::unprocesableResp('Error creating image'), 500);
            }
            $imagenUsuario = $this->imagenUsuario->save([
                'id_usuario' => $authUser->id_usuario,
                'nombre_archivo_imagen_usuario' => $pathImagen
            ]);
            if(!$imagenUsuario){
                return response()->json(ControllerResponses::unprocesableResp('Error creating resource image'), 500);
            }
            $idImage = $imagenUsuario->id_imagen_usuario;
        }

        $this->usuario->save([
            'id_imagen_usuario' => $idImage
        ], $authUser->id_usuario);

        $data = $this->imagenUsuario->byParameters('id_imagen_usuario', '=', $idImage)->first();
        return response()->json(ControllerResponses::okResp($data), 200);
    }

    private function createImage($file, $userPath)
    {
        try{
            $path   =   'images';
            $filename   =   $path . '/' .  date('Ymdhis') . '_' . $userPath . '.jpeg';
            if(!File::exists($path)){
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $image  = Image::make($file);
            $image->save($filename);
            return $filename;
        }catch(FileException $e){
            return false;
        };
    }

}