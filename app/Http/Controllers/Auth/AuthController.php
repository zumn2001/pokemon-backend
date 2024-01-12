<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(AuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('pokemon')->plainTextToken;
        return response()->json([
            'data' => ['user' => $user, 'token' => $token],
            'errors' => [],
            'condition' => true
        ]);
    }

    public function login(AuthRequest $req)
    {
            $user = User::where('email', $req->email)->first();
            if ($user) {
                if (Hash::check($req->password, $user->password)) {
                    $token = $user->createToken('pokemon')->plainTextToken;
                    return response()->json([
                        'data' => ['user' => $user, 'token' => $token],
                        'errors' => [],
                        'condition' => true
                    ], 200);
                } else {
                    return $this->errors([], 'Your password is something wrong!');
                }
            } else {
                return $this->errors([] , 'There is no user with this email!');
            }
        }
}
