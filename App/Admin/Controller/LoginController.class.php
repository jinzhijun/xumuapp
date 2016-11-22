<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    function _initialize(){
        $this->account = cookie("account");
        $this->cid = cookie("cid");
    }
    public function login(){
      $this->display();
    }
    //登出
    public function loginOut(){
        $log = M('admin_login_log');
        $data1['account'] = $this->account;
        $data1['user_id'] = $this->cid;
        $data1['login_time'] = time();
        $data1['status'] = '用户退出';
        $data1['is_login'] = 0;
        $data1['login_ip'] = $_SERVER['REMOTE_ADDR'];
        $add_log = $log->data($data1)->add();
        if($add_log){
            cookie("account",null);
            cookie("cid",null);
            cookie("login_time",null);
            $this->success('退出成功！');
            $this->redirect("Admin/Login/login");
        }
        $this->display();
    }
    //验证用户名密码正确性
    public function loginCheck(){
        $user_name = I("post.username"); 
        $password   = I("post.password");
        $where['account']   = $user_name;
        $where['password']  = md5(md5($password));
        $u = M('admin')->where($where)
        ->find();
        if(!empty($u)){
            $log = M('admin_login_log');
            $data1['account'] = $user_name;
            $data1['user_id'] = $u["id"];
            $data1['status'] = '用户登录';
            $data1['login_time'] = time();
            $data1['login_ip'] = $_SERVER['REMOTE_ADDR'];
            $add_log = $log->data($data1)->add();
            if($add_log){
                $data['result'] = "success";
                cookie("account",$user_name);
                cookie("cid",$u["id"]);
                cookie("login_time",time());
               
            }else{
                $this->error('操作失败，请稍后重试！');
            }
           
        }else{
            $data['result'] = "error";
        }
        
        $this->ajaxReturn($data);
    }
}