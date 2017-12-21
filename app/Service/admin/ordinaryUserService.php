<?php
namespace App\Service\admin;

use App\Models\OrdinaryUser;

use App\Tools\MessageResult;

use Hash;

class ordinaryUserService
{
	public function createOrdinaryUser($param)
	{

		$jsonResult = new MessageResult();

		$count1 = OrdinaryUser::where('username',$param['username'])->count();

		if ($count1 == 1) {
			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "账号已存在";
            return response($jsonResult->toJson());
		}

		if (!empty($param['nickname'])) {
			$count2 = OrdinaryUser::where('nickname',$param['nickname'])->count();

			if ($count2 == 1) {
				$jsonResult->statusCode = 0;
	            $jsonResult->statusMsg = "error";
	            $jsonResult->extra = "用户名已存在";
	            return response($jsonResult->toJson());
			}
			$nickname = $param['nickname'];
		}else{
			$nickname = date('ymdHis').uniqid();
		}
		
		$user = new OrdinaryUser();

		$user->username = $param['username'];
		$user->nickname = $nickname;

		//-----如果密码为空则使用用户名作为密码
		if (empty($param['password'])) {
			$user->password 	= Hash::make($param['username']);
		}else{
			$user->password 	= Hash::make($param['password']);
		}

		$authority = '';
		$room = 0;

		if (!empty($param['authority'])) {
			if (array_key_exists('live',$param['authority'])) {
				$room = $param['room'];
				$authority .= '|live';
			}

			if (array_key_exists('wechat',$param['authority'])) {
				$authority .= '|wechat';
			}
		}

		$user->room = $room;
		$user->authority = $authority;
		$user->headimg = $param['headimg'];
		$user->msg = $param['msg'];
		$user->type = $param['type'];

		if ($user->save()) {

			if (empty($param['nickname'])) {
				$id = $user->id;
				$nickname = "投资大亨_" . $id;
				$update_user = OrdinaryUser::find($id);
				$update_user->nickname = $nickname;

				if ($update_user->save()) {
					$jsonResult->nickupdate = 1;
				}else{
					$jsonResult->nickupdate = 0;
				}
			}

            $jsonResult->statusCode = 1;
            $jsonResult->statusMsg = "success";
        }else{
            $jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
        }

        return response($jsonResult->toJson());
	}



	public function userLogin($param)
	{
		$jsonResult = new MessageResult();

		$username = $param['username'];
		$password = $param['password'];

		$user = OrdinaryUser::where('username',$username)->select('password')->first();

		if (empty($user)) {
			$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "找不到用户";
            return response($jsonResult->toJson());
		}
		
        //---验证密码是否正确
        if (Hash::check($password, $user->password)) {
            //---密码是否需要重新加密
            if (Hash::needsRehash($user->password)) {
                $password = Hash::make($password);
                //---将新的密码更新到数据
                OrdinaryUser::where('username',$request['username'])->update(['password'=>$password]);
            }

            $jsonResult->statusCode = 1;
            $jsonResult->statusMsg = "success";
            $jsonResult->extra = "登陆成功";
            return response($jsonResult->toJson());
        }else{
        	$jsonResult->statusCode = 0;
            $jsonResult->statusMsg = "error";
            $jsonResult->extra = "密码验证失败";
            return response($jsonResult->toJson());
        }

        $jsonResult->statusCode = 2;
        $jsonResult->statusMsg = "notice";
        $jsonResult->extra = "未知原因错误,请联系技术人员";
        return response($jsonResult->toJson());

	}
}



?>