<?php

/**
 * 定义命名空间
 */
namespace Common\Model;

/**
 * 引用文件
 */
use Think\Model;

class LiveuserModel extends Model {
	public function _initialize(){
		$this->model = M('liveuser');
	}
	protected $_validate = array(
		array('user_id','require','请输入客户姓名',1),
		array('user_id','','帐号名称已经存在！',0,'unique',1), 
		array('mobile','require','请填写手机号'),
	    array('truename','require','请填写真实姓名',1),
	);
	//查询列表
	public function Getlist($conditon = "",$field = "*",$order="",$size="10"){
		$result = $this->model->where($conditon)->field($field)->order($order)->limit($size)->page($page)->select();
		return $result;
	}
	//单个查找
	public function Getone($conditon,$field = "*"){
		$result = $this->model->where($conditon)->field($field)->find();
		return $result;
	}
	
	
	//添加
	public function Error($msgTitle,$message,$status,$waitSecond,$jumpUrl){
		
	}
	public function Adduser($data){
		$result = $this->model->data($data)->add();
		if($result){
			return 1;
		}else{
			return 2;
		}
	}
	//修改
	public function Saveuser($where,$data){
		$result = $this->model->where($where)->data($data)->save();
		if( $result ){
			return 1;
		}else{
			return 2;
		}
	}
	
	//删除
	public function user_del($where){
		$result = $this->model->where($where)->delete();
		return $result;
	}

}