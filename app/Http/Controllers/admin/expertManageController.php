<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\admin\expertUserService;
use App\Service\admin\roomService;
use App\Service\admin\imageService;

use App\Tools\MessageResult;

class expertManageController extends Controller
{

	function __construct(expertUserService $expertusersService , roomService $roomService , imageService $imageservice){
		$this->expertuser = $expertusersService;
        $this->room = $roomService;
        $this->image = $imageservice;
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
        return $this->expertuser->createExpertUser($request);
    }

    public function checkDefaultImg($id = 0)
    {
        $imagelist = $this->expertuser->getUserHeading();
        return view('modelsPage.checkDefaultImg')->with('imagelist',$imagelist);
    }


}
