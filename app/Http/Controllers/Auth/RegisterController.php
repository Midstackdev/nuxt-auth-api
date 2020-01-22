<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Resources\PrivateUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

    	if (!$token = auth()->attempt($request->only(['email', 'password']))) {
    		return abort(401);
    	}

    	return (new PrivateUserResource($request->user()))
    		->additional([
    			'meta' => [
    				'token' => $token
    			]
    		]);
    }
}
