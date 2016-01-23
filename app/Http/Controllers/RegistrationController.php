<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegisterUserRequest;

class RegistrationController extends Controller
{
    function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }
	/**
	 *  Authenticates a user
     *
     * @param null
     * @return null
	 */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required', 'password' => 'required',
        ]);
        
        if( $validator->fails() ) {
            return response()->json(['success', 'false', 'messages' => $validator->errors() ], 401);
        }

    	$creds = $request->only('email', 'password');
    	try {
    		if( !$token = JWTAuth::attempt($creds))
    		{
    			return response()->json(['success' => 'false', 'message' => 'invalid credentails'], 401);
    		}
    	} catch (JWTAuthException $e) {
    		return response()->json(['success' => 'false', 'message' => 'Oops something went wrong!'], 500);
    	}

    	return response()->json(['success' => 'true', 'token' => $token]);
    }
    /**
     * Store a new user
     * 
     * @param null
     * @return null
     */
    public function store(RegisterUserRequest $request)
    {
        User::create($request->all());
        return response()->json(['success' => true, 'message' => 'User has been added successfully!']);
    }
}
