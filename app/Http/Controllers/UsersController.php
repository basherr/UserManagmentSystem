<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
	/**
	 * Get all users
	 *
	 * @param null
	 * @return null
	 */
    public function index()
    {
    	return User::all();
    }
    /**
     * Get authenticated user
     *
     * @param null
     * @return null
     */
    public function getAuthenticatedUser()
    {
    	try {
    		if( !$user = JWTAuth::parseToken()->authenticate())
    		{
    			return response()->json(['success' => false, 'message' => 'User not found!'], 404);
    		}
    		
    	} catch (Tymon\JWTAuth\Exceptions\TokenExpireException $e) {
    		return response()->json(['success' => false, 'message' => 'Token expired!'],$e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    		return response()->json(['success' => false, 'message' => 'Invalid token!'],$e->getStatusCode());
    	} catch(Tymon\JWTAuth\Exceptions\JWTException $e) {
    		return response()->json(['success' => false, 'message' => 'Token does not exists!'], $e->getStatusCode());
    	}

    	return response()->json(compact('user'));
    }
}
