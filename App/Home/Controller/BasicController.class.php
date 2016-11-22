<?php
namespace Home\Controller;
use Think\Controller;
class BasicController extends BaseController {
    public function index(){
        $res =  M('Basic_class')
            ->order('id ASC')
            ->select();
        $this->assign('list',$res);
        $this->display();
  }

    public function lists(){
        $where['class_id'] = $_GET['class_id'];
        $res = M('Basic')->order('id asc')->where($where)
            ->select();
        $this->assign('list',$res);
        $this->display();
    }

    public function info(){
        $where['id'] = $_GET['id'];
        $res = M('Basic')->where($where)->find();
        $this->assign('info',$res);
        $this->display();
    }




}


