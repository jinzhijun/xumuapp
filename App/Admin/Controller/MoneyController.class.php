<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class MoneyController extends BaseController {
    public $user;
    public $Model;
    public $com;
    public function _initialize(){
        parent::_initialize();
        $this->com = M('Money');
    }
    //主页内容添加__gadd__
    public function push(){
        $where = '';
        $name = I('name');
        if($name){
            $where['username'] = array("like","%".$name."%");
        }
        $where['type']= 1;//1是提现 2是充值
        $count = M('Money')->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = M('Money')->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->assign('nav_head',C('COMPANY_1'));
        $this->display();
    }


    //主页内容添加__gadd__
    public function recharge(){
        $where = '';
        $name = I('name');
        if($name){
            $where['username'] = array("like","%".$name."%");
        }
        $where['type']= 2;//1是提现 2是充值
        $count = M('Money')->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = M('Money')->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->assign('nav_head',C('COMPANY_1'));
        $this->display();
    }

    //主页修改状态
    public function gshow_change(){
        $money = M('Money')
            ->where(array('id' => $_REQUEST['id']))
            ->find();
        $user =M('user')->where(array('name'=>$money['username']))->find();
        if($money['money']>$user['total_money'] && $_REQUEST['status']==1 && $_REQUEST['type']==1){
            echo "资金不足";exit;
        }
        $res = M('Money')
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('status'=>$_REQUEST['status']));

        if ($res) {
            if($_REQUEST['status']==1 && $_REQUEST['type']==1 ){
                $res =M('user')->where(array('name'=>$money['username']))->setDec('total_money',$money['money']);
            }elseif($_REQUEST['status']==1 && $_REQUEST['type']==2){
                $res =M('user')->where(array('name'=>$money['username']))->setInc('total_money',$money['money']);
            }
            echo "审核完成";
        }
        else {
            echo "审核失败";
        }
    }




}