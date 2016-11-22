<?php
namespace Home\Controller;
use Think\Controller;
class BirthdayController extends BaseController {
    public function index(){
        $res = M('birthday')->find();
        //输出当前产品信息
        $this->assign('info',$res);
       $this->display();
  }

}


