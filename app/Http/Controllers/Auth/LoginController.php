<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginFormRequest $request)
    {
    	if (!$token = auth()->attempt($request->only(['email', 'password']))) {
    		return response()->json([
    			'errors' => [
    				'email' => ['Sorry we couldn\'t sign you in with those details.']
    			]
    		], 422);
    	}
    	
    	return (new PrivateUserResource($request->user()))
    		->additional([
    			'meta' => [
    				'token' => $token
    			]
    		]);
    }
}
