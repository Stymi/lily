<?php
namespace App\Service\admin;

use App\Models\ExpertUsers;
use App\Models\Image;

use App\Service\admin\imageService;

use App\Tools\MessageResult;

use Hash;
/**
* 
*/
class expertUserService
{
	function __construct(imageService $imageservice){
		$this->image = $imageservice;
	}

	public function getExpertList()
	{
		return ExpertUsers::paginate(20);
	}

	public function createExpertUser($request)
	{
		$jsonResult = new MessageResult();

		$param = $request->input();
		$file = $request->file('file');

		$headimg = $param['headimg'];

		//-------使用上传个人头像则需要把图片上传到七牛云
		if ($param['imgtype'] == 2) {
			$result = $this->image->imageUploadQiniu($file);

			if ($result->statusCode !== 1) {
				$jsonResult->statusCode  = 0;
	        	$jsonResult->statusMsg = $result->statusMsg;

	        	return response($jsonResult->toJson());
			}
			else{
				$headimg = $result->link;
			}
		}

		$expertUser = new ExpertUsers();

		$expertUser->nickname 	= $param['nickname'];
		$expertUser->username 	= $param['username'];
		$expertUser->type 		= $param['type'];

		//-----如果密码为空则使用用户名作为密码
		if (empty($param['password'])) {
			$expertUser->password 	= Hash::make($param['username']);
		}else{
			$expertUser->password 	= Hash::make($param['password']);
		}
		
		$expertUser->msg 		= $param['msg'];

		$expertUser->headimg	= $headimg;

		$room = '';

		foreach ($param['room'] as $key => $val) {
			if ($val == 'on') {
				if ($room == '') {
					$room = $key;
				}else{
					$room .= '|'.$key;
				}
			}
		}

		$expertUser->room 			= $room;

		$expertUser->created_at = date('Y-m-d H:i:s');

		if ($expertUser->save()) {
            $jsonResult->statusCode = 1;
            $jsonResult->statusMsg = "success";
        }else{
            $jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
        }

        return response($jsonResult->toJson());

	}

	public function getUserHeading()
	{
		$list = Image::select('id','title','url')->where('c_id',1)->where('status',1)->offset(0)->limit(10)->get();

		$count = Image::where('c_id',1)->where('status',1)->count();

		if ($count < 10) {
			$page = 1;
		}
		elseif (($count % 10) == 0) {
			$page = $count / 10;
		}else{
			$page = ($count / 10) + 1;
		}

		$jsonResult = new MessageResult();

		$jsonResult->list  = $list;
		$jsonResult->count = $count;
		$jsonResult->page  = $page;

		return $jsonResult;
	}

}


?>