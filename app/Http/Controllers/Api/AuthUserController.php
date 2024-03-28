<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\ServiceImpl\AuthService;
use App\Services\ServiceInterfaces\AuthInterface;


class AuthUserController extends Controller
{
    private AuthInterface $authService ;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function userRegister(Request $request){
        $validators = Validator::make($request->all() ,[
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed' ,
            'userName' => 'required|min:3'
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }
     
       $user = $this->authService->register($request, $role = '0');
        return response()->json([ 'data' => $user], 201);
    }

    public function managerRegister(Request $request){
        $validators = Validator::make($request->all() ,[
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed' ,
            'userName' => 'required|min:3'
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }

        $user = $this->authService->register($request, $role = '1');
        return response()->json([ 'data' => $user], 201);
    }

    public function login(Request $request){
        $validators = Validator::make($request->all() ,[
            'email' => 'required|email',
            'password' => 'required|min:8' ,
    
        ]);
        if($validators->fails())
        {
            return response()->json([$validators->errors()], 400);
        }

       $response = $this->authService->login($request);
       return response()->json($response, 201);
    }
}
