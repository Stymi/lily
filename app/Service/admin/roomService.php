<?php
namespace App\Service\admin;

use App\Models\Room;
use App\Models\ExpertUsers;

use App\Tools\MessageResult;
/**
* 
*/
class roomService
{
	
	public function getRoomList()
	{
		return Room::select('id','name')->get();
	}

	public function roomListPaging($limit = 10 , $offset = 0)
	{
		$curr = $offset + 1;

		$offset = ($offset - 1) * $limit;

		$count = Room::count();

		$list = Room::select('id','name','expertid','status','msg','created_at','updated_at')->offset($offset)->limit($limit)->get();

		if ($count < $limit) {
			$page = 1;
		}
		elseif (($count % $limit) == 0) {
			$page = $count / $limit;
		}else{
			$page = ($count / $limit) + 1;
		}

		$jsonResult = new MessageResult();

		$jsonResult->count = $count;
		$jsonResult->curr  = $curr;
		$jsonResult->list  = $list;
		$jsonResult->page  = $page;

		return response($jsonResult->toJson());
	}

	public function getroomListCountPage($limit = 10)
	{
		$count = Room::count();

		if ($count < $limit) {
			$page = 1;
		}
		elseif (($count % $limit) == 0) {
			$page = $count / $limit;
		}else{
			$page = ($count / $limit) + 1;
		}

		$jsonResult = new MessageResult();

		$jsonResult->count = $count;
		$jsonResult->page  = $page;

		return $jsonResult;
	}


	public function createRoom($param)
	{
		$jsonResult = new MessageResult();

		$count = Room::where('name',$param['name'])->count();


		if ($count > 0) {
			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "直播室已存在";

            return response($jsonResult->toJson());
		}


		$room = new Room();

		$room->name 	= $param['name'];
		$room->expertid = $param['expert'];
		$room->status 	= $param['status'];
		$room->msg 		= $param['msg'];

		if ($room->save()) {
            $jsonResult->statusCode = 1;
            $jsonResult->statusMsg = "success";
            $jsonResult->extra = "创建成功";
        }else{
            $jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "存入数据库失败";
        }

        return response($jsonResult->toJson());
	}


	
}



?>