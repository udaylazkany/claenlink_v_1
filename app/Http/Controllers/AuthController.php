<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
class AuthController extends Controller
{protected $authService;

    public function __construct(AuthService  $authService){
     $this->authService = $authService;
    }    
    public function login(LoginRequest $request)
    {try{
        $result = $this->authService->login($request->validated());
         return response()->json($result);
         }
         catch(\Exception $e){
return response()->json(['message'=>$e->getMessage()],401);
         }
        }
}
