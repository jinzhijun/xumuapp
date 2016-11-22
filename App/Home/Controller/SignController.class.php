<?php
namespace Home\Controller;
use Think\Controller;
class SignController extends BaseController {
    public function index(){
        //type  1 手动添加   2 是生日积分  3大转盘 4 商城积分兑换商品积分  5 业务积分转化商城积分 6 广告积分
        $where['username'] = $_GET['username'];
        $res =  M('Sign')
            ->order('id ASC')
            ->where($where)
            ->select();
        $this->assign('list',$res);
        $this->display();
  }


    //主页修改
    public function xieyi() {
        $list = M('Sign_xieyi')->find();
        $this->assign('info',$list);
        $this->display();
    }

}


