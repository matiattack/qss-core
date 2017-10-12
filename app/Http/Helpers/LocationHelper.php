<?php namespace App\Http\Helpers;

use App\Repositories\Ciudad\CiudadEntity;
use App\Repositories\Estados\EstadoEntity;
use App\Repositories\Paises\PaisEntity;

class LocationHelper
{

    public static function resolverLocation($pais, $region, $ciudad)
    {
        $country = self::resolveCountry($pais);
        $state = self::resolveState($region, $country->id);
        $city = self::resolveCity($ciudad, $state->id);

        return $city->id;

        /*return (object)[
            'id' => $city->id,
            'latitud' => (isset($location['latitud']))?$location['latitud']:'',
            'longitud' => (isset($location['longitud']))?$location['longitud']:'',
            'direccion' => (isset($location['direccion']))?$location['calle'] . ' '. $location['direccion']:''
        ];*/
    }

    public static function resolveCountry($name)
    {
        $paisEntity = new PaisEntity();
        if(! $country = $paisEntity->where('nombre_pais', '=', $name)->get()->first()){
            $country = $paisEntity->create([
                'nombre_pais' => $name
            ]);
        }
        return $country;
    }

    public static function resolveState($name, $countryId)
    {
        $estadoEntity = new EstadoEntity();
        if(! $state = $estadoEntity->where('id_pais', '=', $countryId)->where('nombre_estado', '=', $name)->get()->first()){
            $state = $estadoEntity->create([
                'nombre_estado' => $name,
                'id_pais' => $countryId
            ]);
        }
        return $state;
    }

    public static function resolveCity($name, $stateId)
    {
        $ciudadEntity = new CiudadEntity();
        if(! $city = $ciudadEntity->where('id_estado', '=', $stateId)->where('nombre_ciudad', '=', $name)->get()->first()){
            $city = $ciudadEntity->create([
                'nombre_ciudad' => $name,
                'id_estado' => $stateId
            ]);
        }
        return $city;
    }

}