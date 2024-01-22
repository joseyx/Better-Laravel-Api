<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //check if user has extradata
    public function index() {

        //get all users
        $users = User::all();

        return response()->json([
            'users' => $users
        ], 200);
    }


    public function show($id) {


        //find user by id
        $user = User::find($id);

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
        $user->lastName = $request->lastName;
        $user->cedula = $request->cedula;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->ciudad = $request->ciudad;
        $user->estado = $request->estado;
        $user->foto = $request->foto;

        $user->save();


        return response()->json([
            'message' => 'Usuario actualizado',
            'user' => $user
        ], 200);
    }
}
