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
        $imagelist = $this->image->getImageList();
    	return view('imageManage.indexPage')->with('imagelist',$imagelist);
    }

    public function uploadImagePage()
    {
        $categorylist = $this->image->getCategoryListAll();

    	return view('imageManage.uploadImagePage')->with('categorylist',$categorylist);
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

    public function createImageFile(Request $request)
    {
        return $this->image->createImageFile($request);
    }

    public function deleteImageFile(Request $request)
    {
        return $this->image->deleteImageFile($request);
    }

    public function getImageListByCatIDLimit(Request $request)
    {
        return $this->image->getImageListByCatIDLimit($request->input('catid'),$request->input('limit'),$request->input('offset'));
    }

    

   
}
