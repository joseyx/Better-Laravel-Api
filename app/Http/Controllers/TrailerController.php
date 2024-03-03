<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import traile model
use App\Models\Trailer;

class TrailerController extends Controller
{
    // return all trailers in json format
    public function index()
    {
        $trailers = Trailer::all();

        return response()->json([
            'trailers' => $trailers
        ], 200);
    }

    // create a new trailer
    public function create(Request $request)
    {
        $trailer = new Trailer();
        $trailer->title = $request->title;
        $trailer->link = $request->link;
        $trailer->save();

        return response()->json([
            'message' => 'Trailer creado',
            'trailer' => $trailer
        ], 201);
    }

    // update a trailer
    public function update(Request $request, $id)
    {
        $trailer = Trailer::find($id);

        if (!$trailer) {
            return response()->json([
                'message' => 'Trailer no encontrado'
            ], 404);
        }

        $trailer->title = $request->title;
        $trailer->link = $request->link;
        $trailer->save();

        return response()->json([
            'message' => 'Trailer actualizado',
            'trailer' => $trailer
        ], 200);
    }

    // get a trailer
    public function show($id)
    {
        $trailer = Trailer::find($id);

        if (!$trailer) {
            return response()->json([
                'message' => 'Trailer no encontrado'
            ], 404);
        }

        return response()->json([
            'trailer' => $trailer
        ], 200);
    }

    // delete a trailer
    public function destroy($id)
    {
        $trailer = Trailer::find($id);

        if (!$trailer) {
            return response()->json([
                'message' => 'Trailer no encontrado'
            ], 404);
        }

        $trailer->delete();

        return response()->json([
            'message' => 'Trailer eliminado'
        ], 200);
    }
}
