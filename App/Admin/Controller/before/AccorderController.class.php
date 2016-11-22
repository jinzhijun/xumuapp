<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class AccorderController extends BaseController {
    public $user;
    public function _initialize(){
        parent::_initialize();
        $this->order = D('Accorder');
    }
    //订单首页
    public function index(){
    	$where = "";
    	$name = I('company_name');
    	if($name){
           $where['acc_id'] = array("like","%".$name."%");
        } 
    	$count = $this->order->where($where)->count();
    	$page = new Page($count,10);
		$list = $this->order->where($where)->limit($page->firstRow.','.$page->listRows)->select();
        foreach( $list as $k=>$v ){
        	$list[$k]['state'] = $this->change_state($v['state']);
        	$list[$k]['hospital'] = $this->change_hospital($v['hospital']);
        }
		$this->assign('list',$list);
		$this->assign('name',$name);
		$this->assign('page', $page->show());
      	$this->display();
    }
    
    //订单状态 
    public function change_state($state){
    	switch($state){
    		case '0':
    			$state = '未确定方案';
    			break;
    		case '1':
    			$state = '已确定方案，未设置';
    			break;
    		case '2':
    			$state = '已设置，未开始';
    			break;
    		case '3':
    			$state = '已设置，已开始';
    			break;
    		case '3.1':
    			$state = '挂号中';
    			break;
    		case '3.2':
    			$state = '看诊';
    			break;
    		case '3.3':
    			$state = '开始就诊';
    			break;
    		case '3.4':
    			$state = '接受就诊资料';
    			break;
    		case '4':
    			$state = '已结束';
    			break;
    		default:
    			$state = '无效';
    			break;
    	}
    	return $state;
    }
    
    //选出医院
    public function change_hospital($h_id){
    	if(!$h_id) return "匿名";
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->select();
		foreach( $hospital_list as $k=>$v ){
			if($h_id == $v['id']){
				return $v['name'];break;
			}
		}
		return "匿名";
    }
    
    
    //查看陪诊人员信息
    public function info(){
    	$where['id'] = I('id');
        $res = $this->order->Getone($where);
        $res['acc_start_time'] = $res['acc_start_time']?date("Y:m:d H:i:s",$res['acc_start_time']):"";
        $res['acc_end_time'] = $res['acc_end_time']?date("Y:m:d H:i:s",$res['acc_end_time']):"";
        $res['time'] = $res['time']?date("Y-m-d",$res['time']):"";
        $res['hospital'] = $this->change_hospital($res['hospital']);
        $this->assign('list',$res);
        $this->display();
    }

}