<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtiene todas las peliculas
        $peliculas = Pelicula::all();

        // Retorna las peliculas en formato JSON
        return response()->json([
            'peliculas' => $peliculas
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Guarda una pelicula en la base de datos
        $pelicula = new Pelicula([
            'nombre' => $request->nombre,
            'sinopsis' => $request->sinopsis,
            'fecha_estreno' => $request->fecha_estreno,
            'poster' => $request->poster,
        ]);

        // Guarda la pelicula
        $pelicula->save();

        // Retorna la pelicula en formato JSON
        return response()->json([
            'message' => 'Pelicula creada',
            'pelicula' => $pelicula
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Consigue una pelicula especifica por el id
        $pelicula = Pelicula::find($id);

        if (!$pelicula) {
            return response()->json([
                'message' => 'Pelicula no encontrada'
            ], 404);
        }
        return response()->json([
            'pelicula' => $pelicula
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Obtiene la pelicula a editar por el id
        $pelicula = Pelicula::find($id);

        // Actualiza la pelicula
        $pelicula->nombre = $request->nombre;
        $pelicula->sinopsis = $request->sinopsis;
        $pelicula->fecha_estreno = $request->fecha_estreno;
        $pelicula->poster = $request->poster;

        $pelicula->save();

        // Retorna la pelicula en formato JSON
        return response()->json([
            'message' => 'Pelicula actualizada',
            'pelicula' => $pelicula
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Elimina una pelicula especifica por el id
        $pelicula = Pelicula::find($id);

        $pelicula->delete();

        // Retorna respuesta en formato JSON
        return response()->json([
            'message' => 'Pelicula eliminada'
        ], 204);
    }
}
