<?php namespace App\Http\Controllers;


use App\Http\Controllers\Base\RestController;
use App\Repositories\Horarios\Horario;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\ControllerResponses;
use Validator;

class ScheduleController extends RestController
{
    private $horario;

    public function __construct(Horario $horario)
    {
        $this->middleware('cors');
        $this->horario = $horario;
    }

    function getRepository()
    {
        $this->settings('show',['with' => ['usuario']]);
        return $this->horario;
    }

    public function store(Request $request)
    {
        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $validation = $this->validateRequest($request->all());

        if ($validation->fails()) {
            return ControllerResponses::unprocesableResp($validation->errors()->all());
        }

        $schedule = $this->horario->save([
            'id_usuario' => $authUser->id,
            'dia_horario' => $request->input('day'),
            'inicio_horario' => $request->input('start'),
            'termino_horario' => $request->input('end')
        ]);

        $schedule->load('usuario');
        return response()->json(ControllerResponses::okResp( $schedule ));
    }

    public function update(Request $request, $id)
    {
        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $validation = $this->validateRequest($request->all());

        if ($validation->fails()) {
            return ControllerResponses::unprocesableResp($validation->errors()->all());
        }

        $schedule = $this->horario->save([
            'dia_horario' => $request->input('day'),
            'inicio_horario' => $request->input('start'),
            'termino_horario' => $request->input('end')
        ], $id);

        $schedule->load('usuario');
        return response()->json(ControllerResponses::okResp( $schedule ));
    }

    public function destroy($idSchedule, Request $request)
    {

        $schedules = explode(',', $idSchedule);

        if (!$authUser = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        foreach ($schedules as $schedule){
            $this->horario->save([
                'estado_registro_horario' => false
            ], $schedule);
        }
        return response()->json(ControllerResponses::okResp([]));
    }

    public function byUser($id)
    {
        $schedules = $this->horario->byParameters('id_usuario', '=', $id);
        return response()->json(ControllerResponses::okResp($schedules));
    }

    private function validateRequest($request)
    {
        $validation = Validator::make($request, [
            'day' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
        return $validation;
    }
}