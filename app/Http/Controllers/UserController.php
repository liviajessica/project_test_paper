<?php

namespace App\Http\Controllers;

use App\User;
use App\UserToken;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password2' => 'required|min:6|same:password'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // return response()->json([
        //     'success' => true,
        //     'data' => $user
        // ], 200);
        return redirect('/');
    }

    public function create(Request $request)
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Invalid Email or Password',
            // ], 401);
            return redirect('/');
        }

        $User = UserToken::where('email', $request->email)->where('deleted_at', null)->first();
        if ($User == null) {
            UserToken::create([
                'email' => $request->email,
                'token' => $jwt_token
            ]);
            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            UserToken::where('token', $request->token)->delete();
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
        return redirect('/');
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}
