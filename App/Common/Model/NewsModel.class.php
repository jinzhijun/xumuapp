<?php

/**
 *  author:Allen
 */

/**
 * 定义命名空间
 */
namespace Common\Model;

/**
 * 引用文件
 */
use Think\Model;

class NewsModel extends Model {
	public function _initialize(){
        $this->model = M('news');
    }
    
    protected $_validate=array(
		array('title','require','标题必须填写!'),
	    array('editor_notice','require','内容必须填写!'),
	//	array('acc_id','','用户名已经存在！',0,'unique',1),
	///	array('mobile','/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/','请填写正确的电话号码！',0,'regex',1),
		);
    
	//查询列表
	public function getlist($conditon = "",$field = "*",$size="10"){
		$result = $this->model->where($conditon)->field($field)->order()->limit($size)->page($page)->select();
		return $result;
	}
	//单个查找
	public function getone($conditon = "",$field = "*"){
		$result = $this->model->where($conditon)->field($field)->find();
		return $result;
	}
	
	
	//添加
	public function add($data=array()){
		$result = $this->model->data($data)->add();
		if( $result ){
			return 1;
		}else{
			return 2;
		}
	}
	//修改
	public function save($where=array(),$data=array()){
		$result = $this->model->where($where)->data($data)->save();
		if( $result ){
			return 1;
		}else{
			return 2;
		}
	}
	
	//删除
	public function del($where){
		$result = $this->model->where($where)->delete();
		return $result;
	}
}