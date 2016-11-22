<?php
/*
* y_jgs
* 道
*/
namespace Api\Controller;
use Think\Controller;
use Common\ORG\Util\Page;
use Org\Util\ApiEasemobAction;

class HxgroupController extends Controller {
	
	//分组列表
	public function group_list(){
		$group_model = D('Group_hx');
		$group_condition = array();
		if( I('user_mark') ){
			$user_model = D('User');
			$user_condition = array(
				'name' => I('user_mark'),
			);
			$user_info = $user_model->Getone($user_condition);
			$group_condition['market_id'] = $user_info['group_mark'];
		}
		$list_result = $group_model->getlist($group_condition);
		if( count($list_result) > 0 ){
			$this->ajaxReturn($list_result);
		}else{
			$this->ajaxReturn(array('error'=>'暂无分组'));
		}
		
	}
	//群组成员
	public function group_users(){
		$group_id = I('group_id')?I('group_id'):$this->ajaxReturn(array('error'=>'请输入群组id'));
	//	$group_id = '210549051492401604';
		$ApiEasemobAction = new ApiEasemobAction();
		$user_result = $ApiEasemobAction->groupsUser($group_id);
		$user_result = json_decode($user_result,true);
		if( isset($user_result['data']) ){
			$user_model = D('User');
			foreach( $user_result['data'] as $k=>$v ){
				if( !$v['member'] ){
					$user_condition = array('name'=>$v['owner']);
				}else{
					$user_condition = array('name'=>$v['member']);
				}
				$user_inforesult = $user_model->Getone($user_condition);
				$user_result['data'][$k]['truename'] = $user_inforesult['truename']?$user_inforesult['truename']:"";
				$user_result['data'][$k]['headurl'] = $user_inforesult['head']?"http://".$_SERVER['HTTP_HOST'].$user_inforesult['head']:"";
			}
			$this->ajaxReturn($user_result);
		}else{
			$this->ajaxReturn(array('error'=>'暂无成员'));
		}
	}
	
	//搜索接口
	public function search(){
		$keyword = I('keyword')?I('keyword'):$this->ajaxReturn(array('error'=>'请输入关键字'));
		$user_model = D('User');
		$user_condition = array();
		$user_condition['truename'] = array('like','%'.$keyword.'%');
		$user_inforesult = $user_model->Getlist($user_condition);
		foreach( $user_inforesult as $k=>$v ){
			$user_inforesult[$k]['head'] = $v['head']?"http://".$_SERVER['HTTP_HOST'].$v['head']:"";
		}
		if( $user_inforesult ){
			$this->ajaxReturn($user_inforesult);
		}else{
			$this->ajaxReturn(array('error'=>'查无此人'));
		}
		
	}
	
	//发送消息
	public function send_message(){
		$from_user = I('from_user')?I('from_user'):$this->ajaxReturn(array('error'=>'请传入发信者标识'));
		$to_user = I('to_user')?I('to_user'):$this->ajaxReturn(array('error'=>'请传入接收者标识'));
		$title = I('title')?I('title'):$this->ajaxReturn(array('error'=>'请传入标题'));
		$content = I('content')?I('content'):$this->ajaxReturn(array('error'=>'请传入内容'));
		try{
        	$message_model = D('Message');
        	$Message_detail_model = D('Message_detail');
        	$message_model->startTrans();
        	//向消息基础表中添加数据
        	$data = array(
				'from_user' =>$from_user,
				'create_time' =>time(),
				'title' =>$title,
				'content' =>$content,
			);
			$add_result = $message_model->add($data);
	        if( !$add_result ){
	        	//throw new \Exception('消息基础表添加失败');
	        	$this->ajaxReturn(array('error'=>'消息基础表添加失败'));
	        }
        	//向消息详情表中添加数据
        	$to_user_arr = explode(",",$to_user);
			foreach( $to_user_arr as $v){
				$data_detail = array(
					'message_id'=>$add_result,
					'from_user' =>$from_user,
					'to_user' => $v,
					'create_time' =>time(),
				);
				//添加到数据库
				$detail_result = $Message_detail_model->add($data_detail);
				if( !$detail_result ){
					$this->ajaxReturn(array('error'=>'消息详情表添加失败'));
				}
			}
			$message_model->commit();
        }catch(\Exception $e){
        	$message_model->rollback();
        	$this->ajaxReturn(array('error'=>$e->getMessage()));
        }
		$this->ajaxReturn(array('success'=>$add_result));
	}
	
	//查询消息
	public function get_message(){
		$user = I('user')?I('user'):$this->ajaxReturn(array('error'=>'请传入人员标识'));
		//发送的
		$message_model = D('Message');
		$Message_detail_model = D('Message_detail');
		$f_condition = array(
			'from_user' => $user,
		);
		$message_model = D('Message');
		$user_model = D('User');
		$f_arr = $message_model->getlist($f_condition);
		foreach( $f_arr as $k=>$v ){
			unset($f_arr[$k]['id']);
			$f_arr[$k]['message_id'] = $v['id'];
			$f_detail_arr = $Message_detail_model->getlist(array('message_id'=>$v['id']),'to_user,is_read');
			$f_detail_touser_str = "";
			$f_noread_people = "";
			$no_read = '0';
			foreach( $f_detail_arr as $kk=>$vv ){
				//查询用户信息
				$f_user_info = $user_model->Getone(array('name'=>$vv['to_user']),'truename');
				//end
				$f_detail_touser_str .= $f_user_info['truename']?$f_user_info['truename'].",":"匿名".$kk.",";
				if( !$vv['is_read'] ){
					$no_read++;
					$f_noread_people .= $f_user_info['truename']?$f_user_info['truename'].",":"匿名".$kk.",";
				}
			}
			$f_arr[$k]['to_user'] = trim($f_detail_touser_str);
			$f_arr[$k]['no_read'] = $no_read;
			$f_arr[$k]['no_read_people'] = trim($f_noread_people);
		}
		//接受的
		$t_condition = array(
			'to_user' => $user,
		);
		$t_arr = $Message_detail_model->getlist($t_condition);
		foreach( $t_arr as $k=>$v ){
			unset($t_arr[$k]['id']);
			$t_arr[$k]['is_read'] = $v['is_read'];
			$mess_result = $message_model->getone(array('id'=>$v['message_id']));
			$t_user_info = $user_model->Getone(array('name'=>$v['from_user']),'truename');
			$t_arr[$k]['from_user_nickname'] = $t_user_info['truename']?$t_user_info['truename']:"匿名";
			$t_arr[$k]['title'] = $mess_result['title'];
			$t_arr[$k]['content'] = $mess_result['content'];
			$t_arr[$k]['create_time'] = $mess_result['create_time'];
		}
		$result_arr = array(
			'from' => $f_arr,
			'to' => $t_arr,
		);
		$this->ajaxReturn($result_arr);
	}
	
	
	public function ceshijson(){
		$arr = array();
		$arr['title'] = '222';
		$arr['content'] = '<p> <img src="/public/upload/back/57996e1ed8490.png" alt="" /> </p>';
		print_r($arr);exit;
		
		
	}
	
}