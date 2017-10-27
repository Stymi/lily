<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Service\admin\imageService;
use App\Tools\MessageResult;

use Qiniu\Auth;  
use Qiniu\Storage\UploadManager;


class ImageController extends Controller
{
    function __construct(imageService $imageservice){
        $this->image = $imageservice;
    }

    public function indexPage()
    {
        
    	return view('imageManage.indexPage');
    }

    public function uploadImagePage()
    {
    	return view('imageManage.uploadImagePage');
    }

    public function imageCategory()
    {
    	return view('imageManage.imageCategory');
    }

    public function createImageCategory(Request $request)
    {
    	return $this->image->createImageCategory($request->input());
    }

    public function imageCategoryList()
    {
        $imageCategory = $this->image->getCategoryList();
        return view('imageManage.imageCategoryList')->with('imageCategory',$imageCategory);
    }

   
}
