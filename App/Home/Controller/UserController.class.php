<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    function _initialize(){
        $this->username = cookie("username");
        $this->encry = cookie("encry");
        if(!$this->username){
            $this->redirect("Home/Login/login");
        }
        $this->checkAdminSession();
    }
    public function lists(){
      $this->display();
  }

}


