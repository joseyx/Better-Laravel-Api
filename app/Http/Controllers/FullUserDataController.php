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
        // Process and save the image
        $imagePath = $this->processAndSaveImage($request->file('image'));

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
            'foto' => $imagePath
        ]);

        return response()->json([
            'message' => 'User data created'
        ], 201);

    }

    private function processAndSaveImage($image)
    {
        $imagePath = $image->store('storage/images');

        return $imagePath;
    }
}
