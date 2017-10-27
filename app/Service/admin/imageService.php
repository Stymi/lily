<?php
namespace App\Service\admin;

use App\Models\ImageCategory;

use App\Tools\MessageResult;

/**
* 
*/
class imageService
{
	
	public function createImageCategory($param = array())
	{
		$jsonResult = new MessageResult();

		if (count($param) < 1) {

			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "无法获取提交数据";
		}

		$vArr = ['c_name','c_status','c_desc'];

		if (!$this->allParamIn($vArr,$param)) {
			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "提交数据有误";
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


	//----验证提交数据是否完整
	public function allParamIn($vArr = array(), $rArr = array())
	{
		if (count($vArr) < 1 || count($rArr) < 1) {
			return false;
		}

		foreach ($vArr as $val) {
			if (!in_array($val, $rArr)) {
				return false;
			}
		}

		return true;
	}
	



}


?>