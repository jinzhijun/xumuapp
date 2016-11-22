<?php
	function res($str,$type){
		if( $type == '1' ){
			$result = array(
				tip => "success",
				info => $str,
			);
		}else if( $type == '2' ){
			$result = array(
				tip => "error",
				info => $str,
			);
		}
		return json_encode($result);
	}
	
	function sexcheck($sex){
		switch( $sex ){
			case '1';
				$sex = "男";
				break;
			
			case '2';
				$sex = "女";
				break;
				
			default:
				$sex = "未知";
				break;
		}
		return $sex;
	}
	
	function allill(){
		$ill_list = M('previous')->where(array('status'=>'1'))->field('id,name,date')->select();
		return $ill_list;
	}
	
	function choosehospital($h_id){
		if(!$h_id) return "匿名";
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->select();
		foreach( $hospital_list as $k=>$v ){
			if($h_id == $v['id']){
				return $v['name'];break;
			}
		}
		return "匿名";
	}
	
	
	function push_send($machine_id,$description,$machine_type="android",$data=array()){
		require_once 'App/Api/push_api/sdk.php';
		// 创建SDK对象.
		$sdk = new PushSDK();
		$channelId = $machine_id;
		if( 'android' == $machine_type ){
			// 设置消息类型为 通知类型.
			$opts = array (
		    	'msg_type' => 1 
			);
			/*$message = array (
			    // 消息的标题.
			    'title' => '【递国之道】',
			    // 消息内容 
			    'description' => $description,
			    "custom_content"=>array('1'=>'5555'), 
			);*/
				
			$message = '{   
                "title": "【递国之道】",  
                "description": '.$description.',  
                "custom_content": {  
                    "user_id":'.$data['user_id'].',   
                    "status":'.$data['status'].', 
                    "order_id":'.$data['order_id'].'}   
            }';
		}elseif( 'ios' == $machine_type ){
			// 设置消息类型为 通知类型.
			$opts = array (
			    'msg_type' => 1,        // iOS不支持透传, 只能设置 msg_type:1, 即通知消息.
			    'deploy_status' => 1,   // iOS应用的部署状态:  1：开发状态；2：生产状态； 若不指定，则默认设置为生产状态。
			);
			/*$message = array (
			    'aps' => array (
			        // 消息内容
			        'alert' => "hello, this message from baidu push service.", 
			    ), 
			);*/
			$message = '{
						    "aps": {  
						         "alert":'.$description.',
						    },
						    "user_id":'.$data['user_id'].',
						    "status":'.$data['status'].',
						    "order_id":'.$data['order_id'].'
						}';
		}

		// 向目标设备发送一条消息
		$rs = $sdk -> pushMsgToSingleDevice($channelId, $message, $opts);
		//$rs = $sdk -> pushMsgToAll($message, $opts);

		// 判断返回值,当发送失败时, $rs的结果为false, 可以通过getError来获得错误信息.
		if($rs === false){
			return 2;
		   //print_r($sdk->getLastErrorCode()); 
		   //print_r($sdk->getLastErrorMsg()); 
		}else{
			return 1;
		    // 将打印出消息的id,发送时间等相关信息.
		    //print_r($rs);
		}

		echo "done!";
	}
	
	function choosetype($id){
		if(!$id) return "无";
		$type_list = M('diagnose_type')->where(array('status'=>'1'))->select();
		foreach( $type_list as $k=>$v ){
			if($id == $v['id']){
				return $v['name'];break;
			}
		}
		return "无";
	}
	
	function alltype(){
		$type_list = array();
		$type_list = M('diagnose_type')->where(array('status'=>'1'))->select();
		return $type_list;
	}
	
	function allprice_type(){
		$type_list = array();
		$type_list = M('price_type')->where(array('status'=>'1'))->select();
		return $type_list;
	}
	
?>