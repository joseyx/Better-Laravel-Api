<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function register(Request $request): JsonResponse {

        //check if user is already registered
        if(User::where('email', $request->email)->first()) {
            return response()->json([
                'message'=> 'El usuario ya existe',
            ], 400);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password)

        ]);

        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message'=> 'Usuario creado',
                'token'=> $token,
            ], 201);

        } else {
            return response()->json([
                'message'=> 'Error al crear el usuario',
            ], 400);
        }
    }

    public function login(Request $request): JsonResponse {

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'message' => 'Unauthorized'
        ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
        'token' =>$token,
        ]);
    }

    public function user(Request $request): JsonResponse {
        return response()->json($request->user());
    }

    public function logout(Request $request): JsonResponse {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Sesion terminada'
        ]);
    }

    public function passwordReset(Request $request): JsonResponse {

        if(!Hash::check($request->old_password, auth()->user()->password)) {
            return response()->json([
                'message' => 'La contraseña actual no coincide con la contraseña proporcionada'
            ], 400);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'message' => 'Contraseña cambiada con exito'
        ]);
    }

    public function forgotPassword(Request $request): JsonResponse {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset link sent to your email.'], 200);
        } else {
            return response()->json(['message' => 'Unable to send reset link'], 400);
        }
    }

    public function resetPassword(Request $request): JsonResponse {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successful.'], 200);
        }

        return response()->json(['message' => 'Invalid token.'], 400);
    }
}
