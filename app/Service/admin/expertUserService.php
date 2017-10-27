<?php
namespace App\Service\admin;

use App\Models\ExpertUsers;

use Hash;
/**
* 
*/
class expertUserService
{
	
	public function getExpertList()
	{
		return ExpertUsers::paginate(20);
	}

	public function createExpertUser($request)
	{
		
		$expertUser = new ExpertUsers();

		$expertUser->nickname 	= $request['nickname'];
		$expertUser->username 	= $request['username'];
		$expertUser->type 		= $request['type'];

		if (empty($request['password'])) {
			$expertUser->password 	= Hash::make($request['username']);
		}else{
			$expertUser->password 	= Hash::make($request['password']);
		}
		
		$expertUser->msg 		= $request['msg'];

		$room = '';

		foreach ($request['room'] as $key => $val) {
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

		return $expertUser->save();

	}

}


?>