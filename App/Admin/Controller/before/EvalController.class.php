<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class EvalController extends BaseController {
    public $user;
    public function _initialize(){
        parent::_initialize();
        $this->setting = M('setting');
    }
    const negative_comment = "negative_comment"; //投诉
    const good_reputation = "good_reputation"; //评价
    const server_date = "server_date"; //服务时间
    const custom_phone = "custom_phone";  //电话
   //评价查看
   public function opinion(){
	   	$sql = "SELECT e.memo,e.type,e.id,e.acc_id,e.order_id,a.expert,a.is_evaluation,a.state,a.user_id,u.name FROM tp_evaluation e LEFT JOIN (SELECT * FROM tp_accorder) a ON e.order_id = a.id LEFT JOIN (SELECT * FROM tp_user) u ON u.id = a.user_id WHERE a.is_evaluation = 1 AND a.state = 4  ";
	   	$model = M();
	   	$res = $model->query($sql);
	   	//dump($res);exit;
   	 	$this->assign('list',$res);
   		$this->display();
   }

   public function index1(){
       $m = M('menu_admin');
       $res = $m->select();
       $this->assign('list',$res);
       $this->display();
   }
   //登录日志
   public function log(){
       $sql = "SELECT b.*,a.account,a.real_name 
           FROM tp_admin_login_log b LEFT JOIN
           tp_admin a ON b.user_id=a.id ORDER BY id DESC";
       $model = M();
       $res = $model->query($sql);
       //dump($res);exit;
       $this->assign('list',$res);
       
       
   
       $this->display();
   }
    //评价查询
    public function index(){
    	$value = self::good_reputation;
    	$this->common_index($value);
    }
    //评价修改
	public function add(){
		$value1 = self::good_reputation;
    	$this->common_save($value1);
    }
    //投诉修改
    public function complaint_save(){
    	$value1 = self::negative_comment;
    	$this->common_save($value1);
    }
    //投诉查询
	public function complaint(){
		$value = self::negative_comment;
    	$this->common_index($value);
    }
    //服务时间查询
    public function date(){
    	$value = self::server_date;
    	$this->common_index($value);
    }
    //服务时间修改
    public function date_save(){
    	$value1 = self::server_date;
    	$this->common_save($value1);
    }
    //电话查询
    public function tel(){
    	$value = self::custom_phone;
    	$this->common_index($value);
    }
    //电话修改
    public function tel_save(){
    	$value1 = self::custom_phone;
    	$this->common_save($value1);
    }
    //公共修改
    public function common_save($value1){
    	if(I('list') !== "" ){
    		$value['value'] = I('list');
    		$where = array('name'=> $value1);
    		$res = $this->setting->where($where)->data($value)->save();
    		if($res !== false){
    			$json['result'] = 'success';
    		}else{
    			$json['result'] = 'error';
    		}
    		 
    	}else{
    		$json['result'] = 'error';
    	}
    	$this->ajaxReturn($json);
    }
    //公共查询
    public function common_index($value){
    	$where = array('name'=> $value);
    	$str = $this->setting->where($where)->find();
    	$arr = explode(",",$str['value']);
    	$this->assign('list',$arr);
    	$this->display();
    }
    
}