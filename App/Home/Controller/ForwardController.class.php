<?php
namespace Home\Controller;
use Think\Controller;
class ForwardController extends BaseController {
    public function index(){
        $where['type']= 1;//1是提现 2是充值
        $where['status']= 1;//1是提现 2是充值
        $count = M('Money')->where($where)->count();
        $money = M('Money')->order('id asc')->where($where)
            ->select();
        $this->assign('money',$money);
        $res =M('forward')->order('sort desc')->select();
        $this->assign('list',$res);
        $count= M('forward_sign')->where(array('username'=>$_GET['username']))->count();
        $user= M('user')->where(array('name'=>$_GET['username']))->find();
        $this->assign('user',$user);
        $this->assign('count',$count);
        $this->display();
  }

    //分享页面
    public function share(){
        $url =M('forward')->where(array('id'=>$_GET['id']))->find();
        $ip = $_SERVER["REMOTE_ADDR"];
        $sign=M('forward_sign')->where(array(fid=>$_GET['id'],'ip'=>$ip))->find();
        if(!$sign){
            $date['username']= $_GET['username'];
            $date['ip']= $ip;
            $date['fid']= $_GET['id'];
            $date['date']= time();
            $date['money']= $url['money'];
            $sign=  M('sign_exchange')->find();
            M('user')->where(array('name'=>$_GET['username']))->setInc('total_money',$url['money']);
            M('forward_sign')->add($date);
        }
        redirect("$url[url]"."?id=".$_GET['id']."?title=".$url['title']);
    }
}


