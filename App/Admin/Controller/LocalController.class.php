<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class LocalController extends BaseController {
    public $user;
    public $Model;
    public $com;
    public function _initialize(){
        parent::_initialize();
        $this->com = M('local');
    }
    //主页修改状态
    public function gshow_change(){
        
        $res = $this->com
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('status'=>$_REQUEST['status']));
	    if ($res) {
	      echo "审核完成";
	    }
	    else {
	      echo "审核失败";
	    }
    }
    //主页内容首页__gindex__
    public function gindex(){
        $where = '';
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->com->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res =$this->com->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //print_r($res); exit;
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->assign('nav_head',C('COMPANY_1'));
        $this->display();
    }
    public function test(){
        dump(C('COMPANY_1'));
    }


    //主页修改
    public function gsave_xieyi() {
        if($_POST){
            $where['id'] = $_REQUEST['id'];
            $data['text'] = $_REQUEST['editor_notice'];
            // $data['class_id'] = $_REQUEST['news_class'];
            $data['edit_date'] = time();
            $res = M("record_xieyi")
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
        $res = M('record_xieyi')->find();
        //输出当前产品信息
        $this->assign('list',$res);
        $this->display('xieyi');
    }

    //主页内容添加__gadd__
    public function xieyi(){
        if($_POST){
            $data['text'] = I("editor_notice");
            $data['date'] = time();
            $res = M("record_xieyi")->add($data);
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
        $list = M('record_xieyi')->find();
        $this->assign('list',$list);
        $this->display();
    }








}