<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 2016/1/25
 * Time: 9:53
 */

namespace Admin\Controller;
use Common\ORG\Util\Page;
use Think\Model;

class ProductController extends BaseController
{
    public $stat3;
    public $stat2;
    //控制器初始化
    function _initialize(){
        $this->Model = D('Product');
        $this->stat3 = 3;
        $this->stat2 = 2;
    }
    //查询会员等级
    public function UserGrade(){
        $user_grade = D("UserGrade")->GetList(array("status"=>1));
        $this->assign("UserGrade",$user_grade);
    }
    //首页
    public function index(){
        $where = '';
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->Model->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res =$this->Model->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach($res as $k=>$v){
            $class = D('ProClass')->pc_getone(array('id'=>$v['class']));
            $res[$k]['class']= $class['name'];
        }
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->display();
    }
    //删除单张产品图片
    public function imgDel(){
        $res = M("pro_img")->where(array("id"=>$_REQUEST['pid']))->delete();
       if($res){
         $this->ajaxReturn('success');
       }else{
           $this->ajaxReturn('error');
       }
    }
    //产品图片多张上传
    public function imgUpload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        $data['p_id'] = $_REQUEST['pid'];
        $data['date'] = time();
        $data['url'] =  "/Uploads/" . $info['file']['savepath'] . $info['file']['savename'];
        $res = M("pro_img")->add($data);
        if($res>0){
            $this->ajaxReturn('success');
        }
    }

    //删除
    public function delete_data(){

        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
            foreach ($var as $k=>$v){
                $res = $this->Model->where(array('id'=>$v))->delete();
                if($res){
                    $json['result'] = 'success1';
                }
                else{
                    $json['result'] = 'error';
                }
            }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->Model->where($where)->delete();
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
        }
        $this->ajaxReturn($json);
    }
    //产品相册
    public function proPhoto(){
        $this->assign('statu',$this->stat2);
        $where['id'] = $_REQUEST['id'];
       // dump($where);
        $res = $this->Model->where($where)->find();
         //输出当前产品信息
        $this->assign('list',$res);
        $pic = M("pro_img")->field("id,p_id,url")
            ->where(array("p_id"=>$_REQUEST['id'],"status"=>1))
            ->order('sort asc')
            ->select();
        $this->assign('pic',$pic);
        $this->display('add');
    }
    //产品编辑
    public function edit_pro(){
        if($_POST) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            // 上传文件
            $info = $upload->upload();
            if($info){
                $where['id'] = $_REQUEST['id'];
                $res = $this->Model->where($where)->find();
                //file01 判断
                if($_POST['file011'] == 2){
                    //如果等于2，新上传图片
                    $file01 =  "/Uploads/" . $info['file01']['savepath'] . $info['file01']['savename'];
                }elseif($_POST['file011'] == 1) {
                    //如果等于1，删除原图片
                    $file01 = "";
                }elseif($_POST['file011'] == 0) {
                    //如果等于0，保存原图片
                    $file01 = $res['main_img'];
                }
                $data['main_img'] = $file01;
            }
           if ($_REQUEST['name'] == '') {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('请填写产品名称！');</script>";
                exit;
            } else {
                $data['name'] = trim($_REQUEST['name']);
            }
            $data['text'] = $_REQUEST['editor_notice'];
            $data['goods_total'] = $_REQUEST['goods_total'];
            $data['shop_price'] = $_REQUEST['shop_price'];
            $data['sort'] = $_REQUEST['sort'];
            $data['intro'] = trim($_REQUEST['intro']);
            $data['class'] = $_REQUEST['news_class'];
            $where['id'] = I('id');
            $data['date'] = time();
            $res = $this->Model->where($where)->data($data)->save();
            if ($res) {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"" . U(CONTROLLER_NAME . '/index') . "\";</script>";
                exit;
            } else {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');</script>";
                exit;
            }
        }
            $where['id'] = $_REQUEST['id'];
            $res = $this->Model->where($where)->find();
            $class = D('ProClass')->pc_getlist();
            $pic = M("pro_img")->field("id,p_id,url")
                    ->where(array("p_id"=>$_REQUEST['id'],"status"=>1))
                ->order('sort asc')
                ->select();
          $this->assign('statu',$this->stat3);
            $this->assign('pic',$pic);
            //输出全部产品分类
            $this->assign('class',$class);
             //输出当前产品信息
            $this->assign('list',$res);
            //输出产品other_img字段
            $this->assign('list_img',$other_img);
            $this->display('add');
    }

    //创建新产品
    public function add(){
        if($_POST){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            // 上传文件
            $info = $upload->upload();
            if($info){
                $where['id'] = $_REQUEST['id'];
                $res = $this->Model->where($where)->find();
                //file01 判断
                if($_POST['file011'] == 2){
                    //如果等于2，新上传图片
                    $file01 =  "/Uploads/" . $info['file01']['savepath'] . $info['file01']['savename'];
                }elseif($_POST['file011'] == 1) {
                    //如果等于1，删除原图片
                    $file01 = "";
                }elseif($_POST['file011'] == 0) {
                    //如果等于0，保存原图片
                    $file01 = $res['main_img'];
                }
                $data['main_img'] = $file01;
            }
            if($_REQUEST['name'] == ''){
                $error = $this->Model->getError();
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('$error');</script>";
                exit;
            }else{
                $data['name'] = trim($_REQUEST['name']);
            }
            if($_REQUEST['editor_notice'] == ''){
                $error = $this->Model->getError();
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('$error');</script>";
                exit;
            }else{
                $data['text'] = $_REQUEST['editor_notice'];
            }
            $data['sort'] = $_REQUEST['sort'];
            $data['intro'] = trim($_REQUEST['intro']);
            $data['grade_id'] = trim($_REQUEST['UserGrade']);
            $data['class'] = $_REQUEST['news_class'];
            $data['date'] = time();
            $res = D("Product")->pro_add($data);
            if($res){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME .'/index')."\";</script>";
                exit;
            }
            else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . ACTION_NAME)."\";</script>";
                exit;
            }
        }
        $this->UserGrade();
        $news_class = M('pro_class')->where('status = 1')->order('sort asc')->select();
        $this->assign('class',$news_class);
        $this->assign('statu',$this->stat3);
        $this->display();
    }
    //分类首页是否启用
    public function show_change(){
        $res = M("product")
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('status'=>$_REQUEST['status']));
    }
}