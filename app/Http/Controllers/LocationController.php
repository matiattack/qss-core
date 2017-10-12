<?php namespace App\Http\Controllers;

use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use App\Http\Helpers\LocationHelper;
use Illuminate\Http\Request;
use App\Repositories\Calles\Calle;
use JWTAuth;
use Validator;

class LocationController extends RestController
{
    private $calle;

    public function __construct(Calle $calle)
    {
        $this->calle = $calle;
    }

    function getRepository()
    {
        return $this->calle;
    }

    public function store(Request $request)
    {
        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required',
            'longitude' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);

        if ($validation->fails()) {
            return ControllerResponses::unprocesableResp($validation->errors()->all());
        }

        $cityId = LocationHelper::resolverLocation($request->input('country'), $request->input('state'), $request->input('city'));

        $street = $this->calle->save([
            'id_ciudad' => $cityId,
            'nombre_calle' => $request->input('name'),
            'numero_calle' => $request->input('number'),
            'latitud_calle' => $request->input('latitude'),
            'longitud_calle' => $request->input('longitude'),
            'id_usuario' => $authUser->id
        ]);
        $street->load('ciudad');
        return response()->json(ControllerResponses::okResp($street));
    }

    public function byUser($id)
    {
        $this->calle->with('ciudad');
        $locations = $this->calle->byParameters('id_usuario', '=', $id);
        return response()->json(ControllerResponses::okResp($locations));
    }

    public function destroy($idSchedule, Request $request)
    {

        $locations = explode(',', $idSchedule);

        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        foreach ($locations as $location){
            $this->calle->save([
                'estado_registro_calle' => false
            ], $location);
        }

        return response()->json(ControllerResponses::okResp([]));
    }

}