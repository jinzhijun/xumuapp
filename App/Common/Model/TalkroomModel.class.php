<?php

/**
 * author yxf
 */

/**
 * 定义命名空间
 */
namespace Common\Model;

/**
 * 引用文件
 */
use Think\Model;

class TalkroomModel extends Model {
	public function _initialize(){
		$this->model = M('talkroom');
	}
	protected $_validate = array(
		array('room_id','require','请输入房间标识',1),
		array('room_id','','房间标识已存在！',0,'unique',1),
	//	array('mobile','require','手机号必须填写!'),
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
	public function Addtalk($data){
		$result = $this->model->data($data)->add();
		if($result){
			return 1;
		}else{
			return 2;
		}
	}
	//修改
	public function Savetalk($where,$data){
		$result = $this->model->where($where)->data($data)->save();
		if( $result ){
			return 1;
		}else{
			return 2;
		}
	}
	
	//删除
	public function Talk_del($where){
		$result = $this->model->where($where)->delete();
		return $result;
	}

}