<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class SignController extends BaseController {
    public $user;
    public $Model;
    public $com;
    public function _initialize(){
        parent::_initialize();
        //type  1 手动添加   2 是生日积分  3大转盘 4 商城积分兑换商品积分  5 业务积分转化商城积分 6 广告积分
        $this->com = M('Sign');
    }

    //今日提成明细
    public function index(){
        $where = '';
        $username = I('username');
        if($username){
            $where['username'] = array("like","%".$username."%");
        }
        $strtime= strtotime(date('Y-m-d'));
        $endtime= strtotime(date('Y-m-d'))+86400;
        $where['date']= array('between',"$strtime,$endtime");
        $forward= M('forward_sign')->where($where)->select();
        $this->assign('username',$username);
        $this->assign('list',$forward);
        $this->display();
    }

    //今日积分收支
    public function expend(){
        $where = '';
        $username = I('username');
        if($username){
            $where['username'] = array("like","%".$username."%");
        }
        $strtime= strtotime(date('Y-m-d'));
        $endtime= strtotime(date('Y-m-d'))+86400;
        $where['date']= array('between',"$strtime,$endtime");
        $sign= M('sign')->where($where)->select();
        $this->assign('username',$username);
        $this->assign('list',$sign);
        $this->display();
    }




    //主页内容首页__gindex__
    public function gindex(){
        $where = '';
        $username = I('username');
        if($username){
            $where['username'] = array("like","%".$username."%");
        }
        $count = $this->com->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,20);
        $res =$this->com->order('id desc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();

        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('username',$username);
        $this->assign('nav_head',C('COMPANY_1'));
        $this->display();
    }

    //主页修改
    public function gsave_xieyi() {
        if($_POST){
            $where['id'] = $_REQUEST['id'];
            $data['text'] = $_REQUEST['editor_notice'];
            // $data['class_id'] = $_REQUEST['news_class'];
            $data['edit_date'] = time();
            $res = M("Sign_xieyi")
                ->where($where)
                ->data($data)
                ->save();
            if($res){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/gsave_xieyi')."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/gsave_xieyi')."\";</script>";
                exit;
            }
        }
        $res = M('Sign_xieyi')->find();
        //输出当前产品信息
        $this->assign('list',$res);
        $this->display('xieyi');
    }

    //主页内容添加__gadd__
    public function xieyi(){
        if($_POST){
            $data['text'] = I("editor_notice");
            $data['date'] = time();
            $res = M("Sign_xieyi")->add($data);
            if($res > 0){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME .'/xieyi')."\";</script>";
                exit;
            }
            else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . ACTION_NAME)."\";</script>";
                exit;
            }
        }
        $list = M('Sign_xieyi')->find();
        $this->assign('list',$list);
        $this->display();
    }


    //主页内容添加__gadd__
    public function exchange(){
        if($_POST){
            $exchange= M("Sign_exchange")->find();
            if(!$exchange){
                $data['click'] = I("click");
                $data['signed'] = I("signed");
                $data['date'] = time();
                $res = M("Sign_exchange")->add($data);
            }else{
                $data['click'] = I("click");
                $data['signed'] = I("signed");
                $res = M("Sign_exchange")->where(array('id'=>$exchange['id']))->data($data)->save();
            }
            if($res > 0){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME .'/exchange')."\";</script>";
                exit;
            }
            else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME .'/'. ACTION_NAME)."\";</script>";
                exit;
            }
        }
        $list = M('Sign_exchange')->find();
        $this->assign('list',$list);
        $this->display();
    }

    //主页内容添加__gadd__
    public function budget(){
        $where = '';
        $name = I('name');
        if($name){
            $where['username'] = array("like","%".$name."%");
        }
        $count = M('money_exchange')->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,20);
        $res = M('money_exchange')->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //print_r($res); exit;
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->assign('nav_head',C('COMPANY_1'));
        $this->display();
    }


    //主页修改状态
    public function gshow_change(){
        $money = M('money_exchange')
            ->where(array('id' => $_REQUEST['id']))
            ->find();
        $user =M('user')->where(array('name'=>$money['username']))->find();
        if($money['money']>$user['total_money'] && $_REQUEST['status']==1){
            echo "资金不足";exit;
        }
        $res = M('money_exchange')
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('status'=>$_REQUEST['status']));
        if ($res) {
            if($_REQUEST['status']==1){

                $res =M('user')->where(array('name'=>$money['username']))->setDec('total_money',$money['money']);
                $sign = ceil($money['money']*0.56);
                $res1 =M('user')->where(array('name'=>$money['username']))->setInc('total_score',$sign);
                echo M('user')->getLastSql(); exit;
                $info['username']= $money['username'];
                $info['sign']= $sign;
                $info['date']= time();
                $info['type']= 4;//积分兑换
                M('sign')->add($info);
            }
            echo "审核完成";
        }
        else {
            echo "审核失败";
        }
    }




}