<?php
namespace Home\Controller;
use Think\Controller;
class CompanyController extends BaseController {
    public function index(){
        $where['status'] = 1;
        $res =M('company')->order('sort desc')
            ->where($where)
            ->select();
        $this->assign('list',$res);
        $this->display();
  }

    public function info(){
        $where['id']= $_GET['id'];
        $res =M('company')->where($where)
            ->find();
        $this->assign('info',$res);
        $this->display();
    }

}


