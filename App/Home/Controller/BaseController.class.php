<?php
namespace Home\Controller;
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
        if($_GET['pc']){
            $this->username = cookie("username");
            if(!($this->username)){
                $this->redirect("Home/Login/login");
            }
            $this->checkAdminSession();
        }else{
            $user= M('user')->where(array('name'=>$_REQUEST['username'],'encry'=>$_REQUEST['encry']))->find();
            if(!$user){
                $data['tip'] = "error";
                $data['info'] ='地址错误';
                echo json_encode($data); exit;
            }
        }
    }
    public function checkAdminSession() {
        //设置超时
         $nowtime = time();
         $s_time = cookie('login_time');
        if (($nowtime - $s_time) > 60*300000000000) {
                cookie("username",null);
                cookie("login_time",null);
                $this->error('当前用户未登录或登录超时，请重新登录', U('login/login'));

        } else {
           $_SESSION['login_time'] = $nowtime;
        }
    }


}