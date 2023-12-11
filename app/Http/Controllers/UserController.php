<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index() {

        $users = User::with('extraData')->get();



        return response()->json([
            'users' => $users
        ], 200);
    }
}
