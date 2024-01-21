<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;


class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene los generos de la base de datos
        $generos = Genero::all();

        // Retorna los generos en formato JSON
        return response()->json([
            'generos' => $generos
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Registra un genero en la base de datos
        $genero = new Genero([
            'genero' => $request->genero
        ]);

        // Guarda el genero
        $genero->save();

        return response()->json([
            'message' => 'Genero creado',
            'genero' => $genero
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $genero)
    {
        // Devuelve un genero especifico por el id
        $genero = Genero::find('genero',$genero);

        if (!$genero) {
            return response()->json([
                'message' => 'Genero no encontrado'
            ], 404);
        }
        return response()->json([
            'genero' => $genero
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $genero)
    {
        // Actualiza un genero especifico por el nombre

        $genero = Genero::find('genero',$genero);

        // Actualiza el genero
        $genero->genero = $request->genero;

        $genero->save();

        return response()->json([
            'message' => 'Genero actualizado',
            'genero' => $genero
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $genero)
    {
        // Elimina un genero
        $genero = Genero::find('genero',$genero);

        $genero->delete();

        return response()->json([
            'message' => 'Genero eliminado'
        ], 200);

    }
}
