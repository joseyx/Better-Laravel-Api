<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //check if user has extradata
    public function index() {
        $users = User::with('extraData')->get();

        $usersWithoutExtraData = $users->filter(function ($user) {
            return $user->extraData === null;
        });

        $usersWithExtraData = $users->filter(function ($user) {
            return $user->extraData !== null;
        });

        $mixedUsers = $usersWithExtraData->concat($usersWithoutExtraData);

        return response()->json([
            'users' => $mixedUsers
        ], 200);
    }


    public function show($id) {


        $user = User::with('extraData')->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'user' => $user
        ], 200);
    }

    //function to update user email and name
    public function update(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->extraData->lastName = $request->lastName;
        $user->extraData->cedula = $request->cedula;
        $user->extraData->telefono = $request->telefono;
        $user->extraData->direccion = $request->direccion;
        $user->extraData->ciudad = $request->ciudad;
        $user->extraData->estado = $request->estado;

        $user->save();


        return response()->json([
            'message' => 'Usuario actualizado',
            'user' => $user
        ], 200);
    }
}
