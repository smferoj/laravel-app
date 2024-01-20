<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    final public function login(AuthRequest $request){
        // return $request;
        $user = (new User())->getUserByEmailOrPhone($request->all());
        if($user && Hash::check($request->input('password'), $user->password)){
            $user_data['token'] = $user->createToken($user->email)->plainTextToken;
            $user_data['name']= $user->name;
            $user_data['email']= $user->email;
            $user_data['phone']= $user->phone;
            $user_data['photo']= $user->photo;
            return response()->json($user_data);
        }
        throw ValidationException::withMessages([
                'email'=>['The provided credentials are incorrect']
        ]);
        
    }

    
    final public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['msg' => 'You have successfully logged out']);
    }
    
}




// $user = User::where('email', $request->input('email'))->orWhere('phone', $request->input('email'))->first(); should write in model 
