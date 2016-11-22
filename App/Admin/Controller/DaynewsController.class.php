<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class DaynewsController extends BaseController {
    public $user;
    public $Model;
    public $com;
    public function _initialize(){
        parent::_initialize();
        $this->com = M('daynews');
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

                }else{
                $this->error('操作失败',U(CONTROLLER_NAME.'/gindex'));
        }
        }
        //$this->ajaxReturn($json);
    }


    //主页修改
    public function gsave_data() {
        if($_POST){
            $data['sort'] = $_REQUEST['sort'];
            $where['id'] = $_REQUEST['id'];
            $data['title'] = $_REQUEST['title'];
            $data['text'] = $_REQUEST['editor_notice'];
            // $data['class_id'] = $_REQUEST['news_class'];
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
        //输出当前产品信息
        $this->assign('list',$res);
        $this->display('gadd');
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
        //print_r($res); exit;
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
            $data['text'] = I("editor_notice");
            $data['date'] = time();
            $res = M("daynews")->add($data);
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
        $this->display();
    }
}