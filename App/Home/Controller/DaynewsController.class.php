<?php
namespace Home\Controller;
use Think\Controller;
class DaynewsController extends BaseController {
    public function index(){
        $res =M('daynews')->order('id asc')
            ->select();
        $this->assign('list',$res);
        $this->display();
  }


    public function info(){
        $res =M('daynews')->where(array('id'=>$_GET['id']))->find();
        $this->assign('info',$res);
      $this->display();
  }



}


