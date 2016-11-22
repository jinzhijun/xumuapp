<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public $system_menu;

    public $system_menu_sub_path;

    public $currentMenu = "";

    public $currentTop;

    public $leftMenu;

    public $totalMenu;

    public $currentPower;
    public $cid;
    public $account ;
    function _initialize(){
    	$this->cid = cookie("cid");
    	$this->account = cookie("account");
        if(!isset($this->account) || !($this->account)){
            $this->redirect("Admin/Login/login");
        }
        $this->getleft();
        $this->gethead();
        $this->checkAdminSession();
    }
    public function checkAdminSession() {
        //设置超时
         $nowtime = time();
        $s_time = cookie('login_time');
       // echo $nowtime;
        //echo "<br>";
        //echo $s_time; 
        if (($nowtime - $s_time) > 60*300000000000) {
            $log = M('admin_login_log');
            $data1['account'] = $this->account;
            $data1['user_id'] = $this->cid;
            $data1['login_time'] = time();
            $data1['status'] = C('login_01');
            $data1['login_ip'] = $_SERVER['REMOTE_ADDR'];
            $add_log = $log->data($data1)->add();
            if($add_log){
                cookie("account",null);
                cookie("cid",null);
                cookie("login_time",null);
                $this->error('当前用户未登录或登录超时，请重新登录', U('login/login'));
            }
          
        } else {
           $_SESSION['login_time'] = $nowtime;
        }
    }
    public function getleft(){
    	//左侧导航列表
    	//dump(cookie("account"));
         
        if($this->account == "admin"){
           // echo '1';
            $this->system_menu = M('menu_admin')->where(array('status'=>1))->order("sort asc")->select();
        }else{
            //echo '2';
            $sel = M('admin')->where(array('id'=>$this->cid))->find();
            $nav = ($sel['nav']);
            $c = explode(',',$nav);
            $this->system_menu = M('menu_admin')->where(array('id'=>array('in',$c),'status'=>1))->order("sort asc")->select();
            $count = count($this->system_menu);
            if($count == '0'){
               echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    		   echo "<script>alert('您没有权限访问，请联系管理员！');</script>";exit;
    		}
        }
        
        $this->assign("system_menu",$this->system_menu);
       // $topMenu = M('menu_admin')->where('parent=0 and status=1')->order("sort asc")->select();
       // $this->assign("topMenu",$topMenu);
        //导航列表end
    }
    
    public function gethead(){
    	$member_name = cookie('account');
    	$admin_model = D('Admin');
    	$condition = array();
    	$condition['account'] = $this->account;
    	$result = $admin_model->Getone($condition);
    	$this->assign("account",$result['account']);
    	$this->assign("real_name",$result['real_name']);
    	$this->assign("create_date",$result['create_date']);
    	$this->assign("status",$result['status']);
    	$this->assign("head",$result['head']);
    	
    }
    
}