<?php
namespace App\Service\admin;

use App\User;

use App\Tools\MessageResult;

class userService
{
	public function getUserListByLimit($param)
	{
		$limit = $param['limit'];
		$offset = $param['offset'];

		$page = $offset + 1;

		if ($offset > 0) {
			$offset = ($offset - 1) * $limit;
		}else{
			$offse = 0;
		}

		$list = User::select('id','name','email','status','msg')->offset($offset)->limit($limit)->get();

		$jsonResult = new MessageResult();

		$jsonResult->offset  = $page;
		$jsonResult->list  = $list;

		return response($jsonResult->toJson());

	}
}


?>