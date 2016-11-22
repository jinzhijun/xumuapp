<?php

/**
 * author Allen
 */

/**
 * 定义命名空间
 */
namespace Common\Model;

/**
 * 引用文件
 */
use Think\Model;

class UserModel extends Model {
	public function _initialize(){
		$this->model = M('user');
	}
	protected $_validate = array(
		array('name','require','请输入客户姓名',1),//必须验证name
		array('mobile','require','手机号必须填写!'),
	 //   array('truename','require','真实姓名必须填写!',1),
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