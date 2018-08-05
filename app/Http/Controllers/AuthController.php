<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use App\User;
use App\UserMetas;
use JWTFactory;
use Validator;
use App\Http\Resources\UserResource;
class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            // 'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $fullname = $request->firstname.' '.$request->lastname;
        $user = User::create([
            // 'name' => $request->get('name'),
            'name' => $fullname,
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'uid_user' => rand(100000000,999999999),
        ]);
        
        UserMetas::create([
            'user_id'   =>  $users->id,
            'firstname' =>  $request->firstname,
            'lastname'  =>  $request->lastname,
            'gender'    =>  $request->gender,
        ]);

        // return response()->json(compact('user'));
        return response()->json($users->id, 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = $this->jwtAuth->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $user = $this->jwtAuth->authenticate($token);
        return response()->json(compact('token', 'user'));
    }

    public function refresh()
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);
        return response()->json(compact('token'));
    }

    public function logout()
    {
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);
        return response()->json(['logout']);
    }
    
    public function me()
    {
        if (!$user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }
        $data = new UserResource($user);
        return response($data);
    }
    public function getUserByUid(request $request)
    {

        $dataU = User::where('uid_user',  $request['uid_user'])->first();
        $data = new UserResource($dataU);
        return response($data);
    }

}