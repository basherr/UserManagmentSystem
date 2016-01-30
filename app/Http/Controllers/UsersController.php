<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use App\User;
use Validator;
use App\Http\Requests;
use App\Http\Requests\RegisterUserRequest;
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
    public function getAuthUser()
    {
    	try {
    		if( !$user = JWTAuth::parseToken()->authenticate())
    		{
    			return response()->json(['success' => false, 'message' => 'User not found!'], 404);
    		}
    	} catch (Tymon\JWTAuth\Exceptions\TokenExpireException $e) {
    		return response()->json(['success' => false, 'message' => 'Token_expired'],$e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    		return response()->json(['success' => false, 'message' => 'Invalid_token'],$e->getStatusCode());
    	} catch(Tymon\JWTAuth\Exceptions\JWTException $e) {
    		return response()->json(['success' => false, 'message' => 'Token_Invalid'], $e->getStatusCode());
    	}

    	return response()->json(compact('user'));
    }
    /**
     * Get user data
     *
     * @param null
     * @return null
     */
    public function show( $id )
    {
        return User::find( $id );
    }
    /**
     *  Update user 
     *
     * @param null
     * @return null
     */
    public function update(Request $request)
    {
        $user = User::findOrFail( $request->id );
        
        $data['name'] = $request->name;
        if($request->email != $user->email)
        {
            $data['email'] = $request->email;
        }
        if($request->password != null)
        {
            $data['password'] = $request->password;
        }
        $validator = $this->is_valid( $data );
        if( $validator->fails() )
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user->email = $request->email;
        $user->name = $request->name;
        $request->password != null ? $user->password = $request->password : '';
        $user->save();
        return response()->json(['success' => true, 'message' => 'User has been updated successfully!']);
    }
    /**
     * 
     */
    public function is_valid(array $data)
    {
        return Validator::make($data, [
                    'name' => 'required|min:2|max:30',
                    'email' => isset($data['email']) ? "required|email|unique:users":"",
                    'password' => isset($data['password']) ? "required|min:4|max:15|confirmed":""
        ]);
    }
    /**
     * Destroy a new user
     *
     * @param null
     * @return null
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'true', 'message' => 'Record has been deleted successfully!']);
    }
}
