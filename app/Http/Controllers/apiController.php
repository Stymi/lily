<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\admin\ordinaryUserService;
use App\Service\admin\imageService;
use App\Service\admin\userService;

class apiController extends Controller
{
	function __construct(ordinaryUserService $ordinaryUserService , imageService $imageservice , userService $userService){
        $this->ordinaryuser = $ordinaryUserService;
        $this->image = $imageservice;
        $this->user = $userService;
	}

    public function userLogin(Request $request)
    {
    	return $this->ordinaryuser->userLogin($request->input());
    }

    public function getImageList()
    {
    	return $this->image->getImageList();
    }

    public function getUserListByLimit(Request $request)
    {
    	return $this->user->getUserListByLimit($request->input());
    }
}
