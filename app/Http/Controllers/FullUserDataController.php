<?php

namespace App\Http\Controllers;

use App\Models\Full_User_Data;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;



class FullUserDataController extends Controller
{
    //
    public function store(Request $request) {

        $userId = $request->user_id;

        $user = User::find($userId);

        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        };

        $user->extraData()->create([
            'lastName' => $request->lastName,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'estado' => $request->estado,
        ]);

        return response()->json([
            'message' => 'User data created'
        ], 201);

    }
}
