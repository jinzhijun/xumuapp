<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class BasicController extends BaseController {
    public $user;
    public $Model;
    public $com;
    public function _initialize(){
        parent::_initialize();
        $this->user = M('Basic_class');
        $this->Model = D("BasicClass");
        $this->com = M('basic');
    }
    //分类首页
    public function index(){
        $name = I('name');
        $where = "";
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->user->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->user->where($where)
        ->order('id ASC')
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->display();
    }
    //分类删除
    public function delete_data(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
            foreach ($var as $k=>$v){
                $res = $this->user->where(array('id'=>$v))->delete();
                if($res){
                    $this->success('操作成功',U(CONTROLLER_NAME.'/index'));
                }
                else{
                    $this->error('操作失败',U(CONTROLLER_NAME.'/index'));
                }
            }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->user->where($where)->delete();
            if($res){
                $this->success('操作成功',U(CONTROLLER_NAME.'/index'));
            }
            else{
                $this->error('操作失败',U(CONTROLLER_NAME.'/index'));
            }
        }
        $this->ajaxReturn($json);
    }
    //主页删除
    public function gdelete_data(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
            foreach ($var as $k=>$v){
                $res = $this->com->where(array('id'=>$v))->delete();
                if($res){
                    $this->success('操作成功',U(CONTROLLER_NAME.'/gindex'));
                }
                else{
                    $this->error('操作失败',U(CONTROLLER_NAME.'/gindex'));
                }
            }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->com->where($where)->delete();
            if($res){
                $this->success('操作成功',U(CONTROLLER_NAME.'/gindex'));
            }
            else{
                $this->error('操作失败',U(CONTROLLER_NAME.'/gindex'));
            }
        }
        $this->ajaxReturn($json);
    }
    //分类修改
    public function save_data() {
        if($_POST){
            $where['id'] = $_REQUEST['id'];
            $data['name'] = $_REQUEST['name'];
            $data['sort'] = $_REQUEST['sort'];
            $data['edit_date'] = time();
            $res = $this->user
                ->where($where)
                ->data($data)
                ->save();
            if($res){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";
                exit;
            }
        }
        $where['id'] = $_REQUEST['id'];
        $res = $this->user->where($where)->find();
        $this->assign('list',$res);
        $this->display('add');
    }

    //主页修改
    public function gsave_data() {
        if($_POST){
            $where['id'] = $_REQUEST['id'];
            $data['title'] = $_REQUEST['title'];
            $data['text'] = $_REQUEST['editor_notice'];
            $data['sort'] = $_REQUEST['sort'];
            $data['class_id'] = $_REQUEST['news_class'];
            $data['edit_date'] = time();
            $res = $this->com
                ->where($where)
                ->data($data)
                ->save();
            if($res){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/gindex')."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/gindex')."\";</script>";
                exit;
            }
        }
        $where['id'] = $_REQUEST['id'];
        $res = $this->com->where($where)->find();
        $class = M('basic_class')->where(array("status"=>1))->select();
        //输出全部产品分类
        $this->assign('class',$class);
        //输出当前产品信息
        $this->assign('list',$res);
        $this->display('gadd');
    }
    //分类修改状态
    public function show_change(){
        $res = $this->user
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('status'=>$_REQUEST['status']));
    }
    //主页修改状态
    public function gshow_change(){
        $res = $this->com
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('status'=>$_REQUEST['status']));
    }
    //主页内容首页__gindex__
    public function gindex(){
        $where = '';
        $title = I('title');
        if($title){
            $where['title'] = array("like","%".$title."%");
        }
        $count = $this->com->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res =$this->com->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach($res as $k=>$v){
             $class = M("basic_class")->where(array('id'=>$v['class_id']))->find();
              $res[$k]['class_id']= $class['name'];
        }
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('title',$title);
        $this->assign('nav_head',C('COMPANY_1'));
        $this->display();
    }
    public function test(){
        dump(C('COMPANY_1'));
    }
    //主页内容添加__gadd__
    public function gadd(){
        if($_POST){
            $data['title'] = $_REQUEST['title'];
            $data['sort'] = $_REQUEST['sort'];
            // $data['intro'] = trim($_REQUEST['intro']);
            $data['class_id'] = $_REQUEST['news_class'];
            $data['text'] = I("editor_notice");
            $data['date'] = time();
            $res = M("basic")->add($data);
            if($res > 0){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME .'/gindex')."\";</script>";
                exit;
            }
            else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . ACTION_NAME)."\";</script>";
                exit;
            }
        }
        $news_class = M('basic_class')->where('status = 1')->order('sort asc')->select();
        $this->assign('class',$news_class);

        $this->display();
    }
    //分类添加
    public function add(){
        if($_POST){
            if($_REQUEST['name'] == ""){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('用户名必须输入！');</script>";
                $this->display();
                exit;
            }else{
                $data['name'] = $_REQUEST['name'];
            }
            $data['sort'] = $_REQUEST['sort'];
            $data['status'] = 1;
            $data['date'] = time();
            $res = $this->Model->pc_add($data);
            if($res){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";
                exit;
            }
        }
        $this->display();
    }

}