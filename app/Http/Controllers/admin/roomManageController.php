<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\admin\roomService;
use App\Service\admin\expertUserService;

class roomManageController extends Controller
{

	function __construct(expertUserService $expertusersService , roomService $roomService){
		$this->expertuser = $expertusersService;
        $this->room = $roomService;
	}

    public function indexPage()
    {
        $cp = $this->room->getroomListCountPage(10);
 
    	return view('roomManage.indexPage')->with('cp',$cp);
    }

    public function createPage()
    {
    	$expertlist = $this->expertuser->getExpertUserList();
    	return view('roomManage.createPage')->with('expertlist',$expertlist);
    }

    public function createRoom(Request $request)
    {
    	return $this->room->createRoom($request->input());
    }

    public function roomListPaging(Request $request)
    {
        return $this->room->roomListPaging($request->input('limit'),$request->input('offset'));
    }
}
