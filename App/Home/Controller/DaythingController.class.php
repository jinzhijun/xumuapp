<?php
namespace Home\Controller;
use Think\Controller;
class DaythingController extends BaseController {
    public function index(){
        if(IS_POST){
            $data['name'] =$_GET['username'];
            $data['text'] =$_POST['des'];
            $data['edit_date'] =time();
            $res =M('daything')->add($data);
            if($res){
                //$this->success('操作成功',U(CONTROLLER_NAME.'/lists'));
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/lists',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . ACTION_NAME,array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }
        }
      $this->display();
  }

    public function lists(){
//        $where['name']= $_COOKIE['name'];
        $res =M('daything')->select();
        $this->assign('list',$res);
        $this->display();
    }



    public function info(){
        if(IS_POST) {
            $reply = M('daything_reply')->where(array('thing_id' => $_POST['id']))->find();
            $data['text']= $_POST['des'];
            $data['edit_date']= time();
            $data['thing_id']= $_POST['id'];
            $data['name']= $_GET['username'];
            if ($reply) {
                $rs = M('daything_reply')->where(array('thing_id'=>$_POST['id']))->save($data);
            }else{
               $rs=  M('daything_reply')->add($data);
            }
            if($rs){
                //$this->success('操作成功',U(CONTROLLER_NAME.'/lists'));
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/lists',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . ACTION_NAME,array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }
        }
        $where['id']= $_GET['id'];
        $res =M('daything')->where($where)->find();
        $this->assign('info',$res);
        $this->display();
    }





}


