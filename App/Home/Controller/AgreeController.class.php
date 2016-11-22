<?php
namespace Home\Controller;
use Common\ORG\Util\Page;
use Think\Controller;
class AgreeController extends BaseController {
    public function index(){
        $where['status'] = 1;
        $agree= M('Agree_class')->where($where)->select();
        $this->assign('list',$agree);
        $this->display();
  }

    public function info(){
        if(IS_POST){
            $data['status'] = $_POST['status'];
            $data['text'] = $_POST['text'];
            $data['class_id'] = $_POST['id'];
            $rs= M('Agree')->add($data);
            if($rs){
                //$this->success('操作成功',U(CONTROLLER_NAME.'/lists'));
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/info',array('id'=>$_POST['id'],'username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . ACTION_NAME,array('id'=>$_POST['id'],'username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }
        }

        $where['class_id'] = $_GET['id'];
        $count = M('Agree')->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,15);
        $res =M('Agree')->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        $count2= M('Agree')->where(array('status'=>2))->count();
        $count3= M('Agree')->where(array('status'=>3))->count();
        $count4= M('Agree')->where(array('status'=>4))->count();
        $count5= M('Agree')->where(array('status'=>5))->count();
        $this->assign('count2', $count2);
        $this->assign('count3', $count3);
        $this->assign('count4', $count4);
        $this->assign('count5', $count5);
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->display();
    }




}


