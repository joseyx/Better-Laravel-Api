<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaDeCine;

class SalaDeCineController extends Controller
{
    //function to create sala de cine
    public function create(Request $request) {
        $salaDeCine = new SalaDeCine();
        $salaDeCine->nombre = $request->nombre;
        $salaDeCine->capacidad = $request->capacidad;
        $salaDeCine->desde = $request->desde;
        $salaDeCine->hasta = $request->hasta;
        $salaDeCine->tipo = $request->tipo;

        $salaDeCine->save();

        return response()->json([
            'message' => 'Sala de cine creada',
            'salaDeCine' => $salaDeCine
        ], 201);
    }

    //function to update a sala de cine
    public function update(Request $request, $id) {
        $salaDeCine = SalaDeCine::find($id);

        if (!$salaDeCine) {
            return response()->json([
                'message' => 'Sala de cine no encontrada'
            ], 404);
        }

        $salaDeCine->nombre = $request->nombre;
        $salaDeCine->capacidad = $request->capacidad;
        $salaDeCine->desde = $request->desde;
        $salaDeCine->hasta = $request->hasta;
        $salaDeCine->tipo = $request->tipo;

        $salaDeCine->save();

        return response()->json([
            'message' => 'Sala de cine actualizada',
            'salaDeCine' => $salaDeCine
        ], 200);
    }

    //function to get a sala de cine
    public function show($id) {
        $salaDeCine = SalaDeCine::find($id);

        if (!$salaDeCine) {
            return response()->json([
                'message' => 'Sala de cine no encontrada'
            ], 404);
        }

        return response()->json([
            'salaDeCine' => $salaDeCine
        ], 200);
    }

    //function to get all the salas de cine
    public function index() {
        $salaDeCine = SalaDeCine::all();

        return response()->json([
            'salaDeCine' => $salaDeCine
        ], 200);
    }
}
