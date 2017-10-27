<?php
namespace App\Service\admin;

use App\Models\Room;
/**
* 
*/
class roomService
{
	
	public function getRoomList()
	{
		return Room::select('id','name')->get();
	}
	
}



?>