<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
class HorarioController extends Controller
{
    //create a new horario
    public function create(Request $request) {
        $horario = new Horario();
        $horario->hora = $request->hora;
        $horario->sala_id = $request->sala_id;
        $horario->pelicula_id = $request->pelicula_id;
        $horario->save();

        return response()->json([
            'message' => 'Horario creado',
            'horario' => $horario
        ], 201);
    }

    //update a horario
    public function update(Request $request, $id) {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json([
                'message' => 'Horario no encontrado'
            ], 404);
        }

        $horario->hora = $request->hora;
        $horario->sala_id = $request->sala_id;
        $horario->pelicula_id = $request->pelicula_id;
        $horario->save();

        return response()->json([
            'message' => 'Horario actualizado',
            'horario' => $horario
        ], 200);
    }

    //get a horario with asientos
    public function show($id) {
        // get horario with asientos and movie and sala
        $horario = Horario::with('asientos', 'pelicula', 'sala')->find($id);

        if (!$horario) {
            return response()->json([
                'message' => 'Horario no encontrado'
            ], 404);
        }

        return response()->json([
            'horario' => $horario
        ], 200);
    }

    //get all horarios
    public function index() {
        // get all horarios with asientos and movie and sala
        $horarios = Horario::with('asientos', 'pelicula', 'sala')->get();

        return response()->json([
            'horarios' => $horarios
        ], 200);
    }

    //delete a horario
    public function destroy($id) {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json([
                'message' => 'Horario no encontrado'
            ], 404);
        }

        $horario->delete();

        return response()->json([
            'message' => 'Horario eliminado'
        ], 200);
    }

    //get all horarios by pelicula
    public function horariosByPelicula($id) {
        $horarios = Horario::where('pelicula_id', $id)->get();

        return response()->json([
            'horarios' => $horarios
        ], 200);
    }

    //get all horarios by sala
    public function horariosBySala($id) {
        $horarios = Horario::where('sala_id', $id)->get();

        return response()->json([
            'horarios' => $horarios
        ], 200);
    }

    //store asientos bought for a function
    public function storeAsientos(Request $request, $id) {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json([
                'message' => 'Horario no encontrado'
            ], 404);
        }


        //receive a list of asientos identificadores bought for a function
        $asientos = $request->asientos;

        // cambia el estado disponible de los asientos con el identifiador
        foreach ($asientos as $asiento) {
            $horario->asientos()->where('identificador', $asiento)->update(['disponible' => false]);
        }

        return response()->json([
            'message' => 'Asientos comprados'
        ], 200);
    }
}
