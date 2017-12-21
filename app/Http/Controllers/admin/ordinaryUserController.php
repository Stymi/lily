<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\admin\roomService;
use App\Service\admin\imageService;
use App\Service\admin\ordinaryUserService;

class ordinaryUserController extends Controller
{

	function __construct(roomService $roomService , imageService $imageservice , ordinaryUserService $ordinaryUserService){
        $this->room = $roomService;
        $this->image = $imageservice;
        $this->ordinaryuser = $ordinaryUserService;
	}

    public function indexPage()
    {
    	return view('ordinaryUser.indexPage');
    }

    public function createPage()
    {
    	$roomlist = $this->room->getRoomList();
    	$img = $this->image->getRandHeadImg();
    	return view('ordinaryUser.createPage')->with('roomlist',$roomlist)->with('img',$img);
    }

    public function createOrdinaryUser(Request $request)
    {
    	return $this->ordinaryuser->createOrdinaryUser($request->input());
    }
}
