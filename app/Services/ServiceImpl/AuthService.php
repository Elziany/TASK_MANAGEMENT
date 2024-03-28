<?php 
namespace App\Services\ServiceImpl ;
use Illuminate\Http\Request;
use App\Services\ServiceInterfaces\AuthInterface ;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthService implements AuthInterface {
    function register(Request $request , $role){
            $user = User::create([
            'userName' => $request->userName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role
        ]);
        return $user;
    }
    
    function login(Request $request)
    {
        $credentials = $request->only(['email' , 'password']);
        if(Auth::attempt($credentials)){
            $user = Auth::user() ;
            $token = $user->createToken('user_token')->plainTextToken;
            return $response = ['token' => $token , 'data' => $user];
        }else{
            return response()->json([ 'message' => 'email or password are incorrect'], 401);
        }
    }
}