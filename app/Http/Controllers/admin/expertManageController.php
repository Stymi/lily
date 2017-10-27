<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\admin\expertUserService;
use App\Service\admin\roomService;

use App\Tools\MessageResult;

class expertManageController extends Controller
{

	function __construct(expertUserService $expertusersService , roomService $roomService){
		$this->expertuser = $expertusersService;
        $this->room = $roomService;
	}

    public function indexPage()
    {
    	$list = $this->expertuser->getExpertList();
    	return view('expertManage.indexPage')->with('list',$list);
    }

    public function createPage()
    {
        $roomlist = $this->room->getRoomList();
    	return view('expertManage.createPage')->with('roomlist',$roomlist);
    }

    public function createExpertUser(Request $request)
    {

        $create = $this->expertuser->createExpertUser($request->input());
        
        $jsonResult = new MessageResult();

        if ($create == 1) {
            $jsonResult->statusCode = 1;
            $jsonResult->statusMsg = "success";
        }else{
            $jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
        }

        return response($jsonResult->toJson());
    }


}
