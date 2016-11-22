<?php
namespace Api\Controller;
use Think\Controller;
class FriendsController extends Controller {
	//亲友列表
	public function getfriends(){
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
		$user_model = D('user');
		$condition = array();
		$condition['name'] = $user_id;
		$result = $user_model->Getone($condition,'id,friends');
		if( !$result ){
			exit(res("无此用户",2));
		}
		$str_user = $result['friends'].",".$result['id'];
		//查看好友列表
		$user_condition = array();
		$user_condition['id'] = array('in',$str_user);
		$frind_result = $user_model->Getlist($user_condition,'id,truename,head,mobile');
		$item =array(
			'tip'=>'success',
			'info'=>$frind_result,
		);
		exit(json_encode($item));
	}
	
	//亲友详情
	public function friend_info(){
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
		$user_model = D('user');
		$condition = array();
		$condition['name'] = $user_id;
		$result = $user_model->Getone($condition,'id,truename,sex,head,mobile,birthday,ill');
		if( !$result ){
			exit(res("无此亲友用户",2));
		}
		$result['sex'] = sexcheck($result['sex']);
		$result['head'] = $result['head']?"http://".$_SERVER['HTTP_HOST'].$result['head']:"";
		$result['birthday'] = $result['birthday']?date("Y-m-d",$result['birthday']):$result['birthday'];
		$result['ill'] = $result['ill']?explode(",",$result['ill']):array();
		$result['allill'] = allill();
		$item =array(
			'tip'=>'success',
			'info'=>$result,
		);
		exit(json_encode($item));
	}
	
	//亲友资料修改
	public function update_friends(){
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
		$data = array();
		$where = array();
		$where['name'] = $user_id;
		$data['sex'] = I("sex");
		$data['birthday'] = strtotime(I("birthday"));
		$data['ill'] = I("ill");
		
		//整理图片
    	$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =     ''; // 设置附件上传（子）目录
		// 上传文件
		$info=$upload->upload();
		if( $info ){
			$imgstr = "";
			foreach( $info as $k=>$v){
				$imgstr .= "/Uploads/".$v['savepath'] . $v['savename'].",";
			}
		}else{
			$imgstr = "";
		}
		$data['head'] = rtrim($imgstr,",");
		
		$user_model = D('user');
		$result_check = $user_model->Getone(array('name'=>$user_id));
		if( !$result_check ){
			exit(res("无此亲友用户",2));
		}
		$result = $user_model->Saveuser($where,$data);
		if( $result !== false ){
			exit(res("修改成功",1));
		}else{
			exit(res("修改失败",2));
		}
	}
	
	
}