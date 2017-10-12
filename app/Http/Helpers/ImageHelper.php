<?php namespace App\Http\Helpers;

use App\Repositories\ImagenesUsuarios\ImagenUsuarioRepository;
use App\Repositories\Usuarios\UsuarioEntity;

use Intervention\Image\Facades\Image;
use File;

class ImageHelper
{

    public static function createUserImage($base64ImageUser, UsuarioEntity $usuario){

        $pathImagen = ImageHelper::createImage($base64ImageUser, strtolower($usuario->username));

        if($pathImagen === false){
            return null;
        }

        $imageUsuarioRepository = new ImagenUsuarioRepository();

        $imagenUsuario = $imageUsuarioRepository->save([
            'id_usuario' => $usuario->id_usuario,
            'nombre_archivo_imagen_usuario' => $pathImagen
        ]);

        if(!$imagenUsuario){
            return null;
        }

        return $imagenUsuario;
    }

    public static function createImage($file, $userPath)
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