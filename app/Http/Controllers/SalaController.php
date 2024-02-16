<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;

class SalaController extends Controller
{
    //function to create sala de cine
    public function create(Request $request) {
        $sala = new Sala();
        $sala->nombre = $request->nombre;
        $sala->filas = $request->filas;
        $sala->asientos_por_fila = $request->asientos_por_fila;
        $sala->tipo = $request->tipo;
        $sala->save();

        return response()->json([
            'message' => 'Sala de cine creada',
            'sala' => $sala
        ], 201);
    }

    //function to update a sala de cine
    public function update(Request $request, $id) {
        $sala = Sala::find($id);

        if (!$sala) {
            return response()->json([
                'message' => 'Sala de cine no encontrada'
            ], 404);
        }

        $sala->nombre = $request->nombre;
        $sala->filas = $request->filas;
        $sala->asientos_por_fila = $request->asientos_por_fila;
        $sala->tipo = $request->
        $sala->save();

        return response()->json([
            'message' => 'Sala de cine actualizada',
            'sala' => $sala
        ], 200);
    }

    //function to get a sala de cine
    public function show($id) {
        $sala = Sala::find($id);

        if (!$sala) {
            return response()->json([
                'message' => 'Sala de cine no encontrada'
            ], 404);
        }

        return response()->json([
            'sala' => $sala
        ], 200);
    }

    //function to get all the salas de cine
    public function index() {
        $sala = Sala::all();

        return response()->json([
            'salas' => $sala
        ], 200);
    }
}
