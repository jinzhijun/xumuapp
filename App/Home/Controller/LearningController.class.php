<?php
namespace Home\Controller;
use Think\Controller;
class LearningController extends BaseController {
    public function index(){
        $where['status'] = 1;
        $res =M('learning')->order('sort desc')
            ->where($where)
            ->select();
        $this->assign('list',$res);
        $this->display();
    }

    public function info(){
        $where['id']= $_GET['id'];
        $res =M('learning')->where($where)
            ->find();
        $this->assign('info',$res);
        $this->display();
    }

}


