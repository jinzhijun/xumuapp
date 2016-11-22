<?php
namespace Home\Controller;
use Think\Controller;
class XieyiController extends BaseController {
    public function index(){
        $list = M('xieyi')->find();
        $this->assign('info',$list);
        $this->display();
  }

}


