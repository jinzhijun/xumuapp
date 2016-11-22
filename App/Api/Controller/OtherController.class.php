<?php
namespace Api\Controller;
use Think\Controller;
use Common\ORG\Util\Serverapi;

class OtherController extends Controller {
	//获取融云token
    public function ry_token(){
    	$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
    	$truename = I("truename")?I("truename"):exit(res("请传入用户真实姓名",2));
    	$portraitUri = I("portraitUri")?I("portraitUri"):exit(res("请传入用户头像",2));
    	$Serverapi = new Serverapi();
		$ret = $Serverapi->getToken($user_id, $truename, $portraitUri);
		$ret = json_decode($ret,true);
		if( $ret['code'] == '200' ){
			$res = array(
				'token'	=>	$ret['token'],
			);
			//最终结果
			$item =array(
				'tip'=>'success',
				'info'=>$res
			);
			exit(json_encode($item));
		}else{
			exit(res("获取失败",2));
		}
    }
}