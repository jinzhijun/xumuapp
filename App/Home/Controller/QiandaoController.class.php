<?php
namespace Home\Controller;
use Think\Controller;
class QiandaoController extends BaseController {
    public function index(){

        $rs= M('Qiandao')->where(array('date'=>strtotime(date('Y-m-d',time())),'username'=>$_GET['username']))->find();
        if($rs){
            //$this->success('操作成功',U(CONTROLLER_NAME.'/lists'));
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('今天已签到');window.location.href=\"".U('Trade/lists',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
            exit;
        }else{
            $sign=  M('sign_exchange')->find();
            $data['date']= strtotime(date('Y-m-d'));
            $data['username']= $_GET['username'];
            M('Qiandao')->add($data);
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('签到成功！');window.location.href=\"".U('Trade/lists',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
        }
  }
}


