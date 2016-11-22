<?php
namespace Api\Controller;
use Think\Controller;
class CodeController extends Controller {
    
    //过期时间
    private $timeout= '5';
    
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
	private $accountSid= '8a48b5515185cb1a01518b323ad4088c';

	//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
	private $accountToken= '90637053383d4909a5167480f5f0e71a';

	//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
	//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
	private $appId='aaf98f8951ce5b650151d20a73c30847';

	//请求地址
	//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
	//生产环境（用户应用上线使用）：app.cloopen.com
	private $serverIP='sandboxapp.cloopen.com';


	//请求端口，生产环境和沙盒环境一致
	private $serverPort='8883';

	//REST版本号，在官网文档REST介绍中获得。
	private $softVersion='2013-12-26';
    
    
    public function getrand_code(){
    	$chars='0123456789';
		mt_srand((double)microtime()*1000000*getmypid()); 
		$CheckCode="";
		while(strlen($CheckCode)<6)
		$CheckCode.=substr($chars,(mt_rand()%strlen($chars)),1);
		return  $CheckCode;
    }
    
    public function check_timeout($name_id){
    	$code_model = M('code');
    	$code_result = $code_model->where(array('name_id'=>$name_id))->find();
    	if( empty($code_result) ){
    		return 3;//无验证码
    	}else{
    		if( (time() - $code_result['time']) > ($this->timeout*60)){
    			return 1;//时间过期
    		}else{
    			return 2;//时间内
    		}
    	}
    }
    
	public function sendTemplateSMS($to,$datas,$tempId){
		// 初始化REST SDK
		//global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
		$rest = new Rest($this->serverIP,$this->serverPort,$this->softVersion);
		$rest->setAccount($this->accountSid,$this->accountToken);
		$rest->setAppId($this->appId);

		// 发送模板短信
		//echo "Sending TemplateSMS to $to <br/>";
		$result = $rest->sendTemplateSMS($to,$datas,$tempId);
		if($result == NULL ) {
		 return false;
		 //echo "result error!";
		 break;
		}
		if($result->statusCode!=0) {
		return false;
		 //echo "error code :" . $result->statusCode . "<br>";
		 //echo "error msg :" . $result->statusMsg . "<br>";
		 //TODO 添加错误处理逻辑
		}else{
		return true;
		 //echo "Sendind TemplateSMS success!<br/>";
		 // 获取返回信息
		 //$smsmessage = $result->TemplateSMS;
		 //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
		 //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
		 //TODO 添加成功处理逻辑
		}
	}
	
	//获取验证码接口 http://192.168.0.66:8090/api.php?m=api&c=Code&a=getcode&name_id=18765218752
	public function getcode(){
		$name_id = I("name_id")?I("name_id"):exit(res("请传入用户id",2));
		$result_time = $this->check_timeout($name_id);
		if( $result_time != '2' ){
			$code_model = M('code');
			$result_code = $this->getrand_code();
			$send_result = $this->sendTemplateSMS($name_id ,array($result_code,$this->timeout),"1");
			if( $send_result ){
				if( $result_time == '3' ){
					$code_id = $code_model->data(array('name_id'=>$name_id,'code'=>$result_code,'time'=>time()))->add();
					if( $code_id ){
						exit(res("发送成功",1));
					}else{
						exit(res("发送成功，但保存验证码失败",2));
					}
				}elseif( $result_time == '1' ){
					$update_result = $code_model->where(array('name_id'=>$name_id))->save(array('code'=>$result_code,'time'=>time()));
					if( $update_result ){
						exit(res("发送成功",1));
					}else{
						exit(res("发送成功，但保存验证码失败",2));
					}
				}
			}else{
				exit(res("发送失败",2));
			}
		}else{
			exit(res("操作频繁，请稍后再试",2));
		}
	}

	//验证验证码是否正确
	public function test_code(){
		$name_id = I("name_id")?I("name_id"):exit(res("请传入用户id",2));
		$code = I("code")?I("code"):exit(res("请传入验证码",2));
		$result_time = $this->check_timeout($name_id);
		if( $result_time != '3' ){
			if( $result_time == '2' ){
				$code_model = M('code');
    			$code_result = $code_model->where(array('name_id'=>$name_id))->find();
    			if( $code == $code_result['code'] ){
    				exit(res("验证成功",1));
    			}else{
    				exit(res("验证码输入错误，请重新输入验证码",2));
    			}
			}elseif( $result_time == '1' ){
				exit(res("验证超时，请重新获取验证码",2));
			}
		}else{
			exit(res("请先获取验证码",2));
		}
	}

}
