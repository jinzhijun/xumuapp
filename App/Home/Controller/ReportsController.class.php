<?php
namespace Home\Controller;
use Think\Controller;
class ReportsController extends BaseController {
    public function index(){
        $list = M('reports')->find();
        $this->assign('info',$list);
      $this->display();
  }

}


