<?php
namespace App\Service\admin;

use App\Models\ImageCategory;
use App\Models\Image;

use App\Tools\MessageResult;

use Qiniu\Auth as QiniuAuth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;

/**
* 
*/
class imageService
{
	private $accessKey = 'vpFrhIueBC_YFje_piLC3Un-n58ZkEu_OmN5ck0X';
    private $secretKey ='PgUljTcIgEMpm2uCbn4gN4X9EgXkJG171YK7eWwu';
    private $bucket = 'find37';
    private $auth;

    function __construct()
	{
		$this->auth = new QiniuAuth( $this->accessKey,  $this->secretKey);
	}

	public function getImageList()
	{
		return Image::All();
	}
	
	public function createImageCategory($param = array())
	{
		$jsonResult = new MessageResult();

		if (count($param) < 1) {

			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "无法获取提交数据";

            return response($jsonResult->toJson());
		}

		unset($param['_token']);

		$vArr = ['c_name','c_status','c_desc'];

		if (!$this->allParamIn($vArr,$param)) {
			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "提交数据有误";

            return response($jsonResult->toJson());
		}

		$ImageCategory = new ImageCategory();

		$ImageCategory->c_name 		= $param['c_name'];
		$ImageCategory->c_status 	= $param['c_status'];
		$ImageCategory->c_desc 		= $param['c_desc'];

		if ($ImageCategory->save()) {
			$jsonResult->statusCode = 1;
            $jsonResult->statusMsg = "success";
            $jsonResult->extra = "存储成功!";
		}else{
			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "存储失败!";
		}

		return response($jsonResult->toJson());
	}

	public function getCategoryList()
	{
		return ImageCategory::select('id','c_name','c_status','c_desc','created_at')->paginate(15);
	}

	public function getCategoryListAll()
	{
		return ImageCategory::select('id','c_name','c_status','c_desc','created_at')->get();
	}

	public function createImageFile($request)
	{
		$file = $request->file('file');
		$param = $request->input();

		$jsonResult = new MessageResult();

		if (count($param) < 1) {

			$jsonResult->statusCode = 0;
            $jsonResult->extra = "error";
            $jsonResult->statusMsg = "无法获取提交数据";

            return response($jsonResult->toJson());
		}

		$vArr = ['imgtitle','imgcategory','type','msg'];

		if (!$this->allParamIn($vArr,$param)) {
			$jsonResult->statusCode = 0;
            $jsonResult->extra = "error";
            $jsonResult->statusMsg = "提交数据有误";

            return response($jsonResult->toJson());
		}

		if ($request->file('file') == 'null') {
			$jsonResult->statusCode = 0;
            $jsonResult->extra = "error";
            $jsonResult->statusMsg = "请上传图片";

            return response($jsonResult->toJson());
		}

		$result = $this->imageUploadQiniu($file);


		if ($result->statusCode !== 1) {
			$jsonResult->statusCode  = 0;
        	$jsonResult->statusMsg = $result->statusMsg;
		}
		else{
			$image = new Image();
			$image->title 	= $param['imgtitle'];
			$image->c_id 	= $param['imgcategory'];
			$image->status 	= $param['type'];
			$image->url 	= $result->link;
			$image->imgkey 	= $result->key;
			$image->desc 	= $param['msg'];

			if ($image->save()) {
				$jsonResult->statusCode  = 1;
        		$jsonResult->statusMsg = "添加成功!";
			}else{
				$jsonResult->statusCode  = 0;
        		$jsonResult->statusMsg = "添加数据库失败!";
			}
		}

		return response($jsonResult->toJson());

	}

	public function deleteImageFile($request)
	{
		$jsonResult = new MessageResult();

		$image_key = $request->input('key');
		$id = $request->input('id');

		$del = $this->imageDeleteQiniu($image_key);

		if ($del->statusCode == 1) {
			$deleteImg = Image::where('id', $id)->delete();

			if ($deleteImg) {
                $jsonResult->statusCode = 1;
                $jsonResult->statusMsg = '删除成功';
            }else{
                $jsonResult->statusCode = 2;
                $jsonResult->statusMsg = '删除失败';
            }
		}else{
			$jsonResult->statusCode = $del->statusCode;
            $jsonResult->statusMsg = $del->statusMsg;
		}

		return response($jsonResult->toJson());
	}

	public function getImageListByCatIDLimit($catid = 0 , $limit = 10 , $offset = 0)
	{
		$curr = $offset + 1;

		$offset = ($offset - 1) * $limit;

		$count = Image::where('c_id',$catid)->where('status',1)->count();

		$list = Image::select('id','title','url')->where('c_id',$catid)->where('status',1)->offset($offset)->limit($limit)->get();

		$jsonResult = new MessageResult();

		$jsonResult->count = $count;
		$jsonResult->curr  = $curr;
		$jsonResult->list  = $list;

		return response($jsonResult->toJson());
	}

	

	//------上传到七牛云
	public function imageUploadQiniu($file)
	{
		$imageObj=null;
        $token = $this->auth->uploadToken($this->bucket);
        $uploadMgr = new UploadManager();
        

        $filename =time().uniqid().'.'.$file->guessExtension();

        list($result,$error) = $uploadMgr->putFile($token, $filename, $file);

        
        if($error == null)
        {
        	$jsonResult = new MessageResult();

        	$jsonResult->statusCode  = 1;
        	$jsonResult->statusMsg = "添加成功!";
        	$jsonResult->link = 'http://image.find37.com/' . $result['key'];
        	$jsonResult->key = $result['key'];
        	$jsonResult->extra = $result;
        }
        else{
            $jsonResult->statusCode  = 3;
            $jsonResult->statusMsg = '上传云端失败';
            $jsonResult->extra = $result;
        }

        return $jsonResult;

	}

	public function imageDeleteQiniu($imageKey)
	{
        $jsonResult = new MessageResult();

        if($imageKey != null){

            //初始化BucketManager
            $bucketMgr = new BucketManager($this->auth);

            //删除$bucket 中的文件 $key
            $err = $bucketMgr->delete($this->bucket, $imageKey);

            if($err == null){
                $jsonResult->statusCode = 1;
                $jsonResult->statusMsg = '删除成功';
            }else{
                $jsonResult->statusCode=3;
                $jsonResult->statusMsg='无法从云端删除';
            }

        }else{
            $jsonResult->statusCode=4;
            $jsonResult->statusMsg='图片不存在';
        }

        return $jsonResult;
	}


	//----验证提交数据是否完整
	public function allParamIn($vArr = array(), $rArr = array())
	{

		if (count($vArr) < 1 || count($rArr) < 1) {
			return false;
		}

		foreach ($vArr as $val) {
			if (!array_key_exists($val, $rArr)) {
				return false;
			}
		}

		return true;
	}
	



}


?>