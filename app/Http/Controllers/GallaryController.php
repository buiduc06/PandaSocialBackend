<?php

namespace App\Http\Controllers;

use App\Gallary;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\GallaryResource;
class GallaryController extends Controller
{

	public function uploadImage(request $rq)
	{

		$user = JWTAuth::parseToken()->authenticate();
		$user_id = $user['id'];

 $uploadPath = public_path('/uploads'); // Thư mục upload

 
 foreach ($rq['upload'] as $file) {
 	$fileExtension =  $file->getClientOriginalExtension(); 
 	$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
 	$file->move($uploadPath, $fileName);

 	$data = Gallary::create([
 		'user_id'	=> $user_id,
 		'post_id'	=> $rq['post_id'],
 		'image'  	=> $fileName,
 		'type' 		=> $fileExtension,
 	]);
 	$returnData[] = new GallaryResource($data);
 }
 // }

 

 return response()->json($returnData, 200);
         // return response()->json( $rq->post_id);
}

}
