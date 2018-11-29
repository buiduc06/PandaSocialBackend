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
use App\Http\Resources\GallaryResource;
use App\Http\Resources\ProfileUserResource;
use Hash;

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
            return response()->json($validator->errors(), 404);
        }

        $fullname = $request->firstname.' '.$request->lastname;
        $user_data = User::create([
            // 'name' => $request->get('name'),
            'name' => $fullname,
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'uid_user' => rand(100000000, 999999999),
        ]);
        
        UserMetas::create([
            'user_id'   =>  $user_data->id,
            'firstname' =>  $request->firstname,
            'lastname'  =>  $request->lastname,
            'gender'    =>  $request->gender,
        ]);

        // return response()->json(compact('user'));
        return response()->json(['tạo tài khoản và đăng kí thành công'], 200);
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

        $dataU = User::where('uid_user', $request['uid_user'])->first();
        $data = new UserResource($dataU);
        return response($data);
    }

    public function searchUser(request $request)
    {
        $user = $this->jwtAuth->parseToken()->authenticate();
        $dataUser = User::where('id', '!=', $user['id'])->where('name', 'LIKE', "%$request->user_name%")->get()->unique();

        return response()->json(UserResource::collection($dataUser), 200);
    }


    public function getDataUserByUid(request $request)
    {

        $dataU = User::where('uid_user', $request['uid_user'])->first();

        if (!empty($dataU)) {
            $data = new ProfileUserResource($dataU);
            return response($data);
        }
        return response(404);
    }
    public function getListFriends()
    {
        $user = $this->jwtAuth->parseToken()->authenticate();
        $data = User::find($user['id'])->getListFriends2();
        $dataFriends = User::whereIn('id', $data)->get();
        return response()->json(UserResource::collection($dataFriends), 200);
    }
    public function changePassword(request $request)
    {
        $user = $this->jwtAuth->parseToken()->authenticate();
        $userChange = User::findOrFail($user['id']);
        if (Hash::check($request['current_password'], $userChange->password)) {
            $pws = Hash::make($request['password']);
            $userChange->update([
              'password'=>$pws
            ]);
            return response()->json(200);
        }
        return response()->json(['msg'=>'mật khẩu cũ không chính xác'], 404);
    }
    public function changeAvatar(request $request)
    {
        $validator = Validator::make($request->all(), [
        'upload' => 'required|image',
        ], [
        'upload.required'=>'vui lòng chọn file của bạn',
        'upload.image'=>'định dạng ảnh ko hợp lệ',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }


        $user = $this->jwtAuth->parseToken()->authenticate();
        $userChange = User::findOrFail($user['id']);
        $user_id = $user['id'];
        $dataChane = UserMetas::where('user_id', $user_id)->first();
        $uploadPath = public_path('/uploads'); // Thư mục upload

        $fileExtension =  $request['upload']->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
        $request['upload']->move($uploadPath, $fileName);
        if ($request['type'] =='avatar') {
            $dataChane->update([
              'avatar'     => $fileName,
            ]);
        } else {
            $dataChane->update([
            'banner'     => $fileName,
            ]);
        }
        return response()->json($dataChane->getAvatar(), 200);
    }
    public function changeStatusOnline(request $request)
    {
        $user = $this->jwtAuth->parseToken()->authenticate();
        $userChange = User::findOrFail($user['id']);
        $userChange->update([
            'status_online'=> $request->data
        ]);
        return response()->json($request->data, 200);
    }
}
