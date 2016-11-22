<?php
namespace Home\Controller;

use Common\ORG\Util\CImage;
use Think\Controller;
class RecordController extends BaseController {
    public function index(){
        $user= M('user')->where(array('name'=>$_GET['username']))->find();
        $this->assign('user',$user);
        $record= M('record')->where(array('username'=>$_GET['username']))->find();
        $this->assign('info',$record);
        $this->display();
    }
    //主页修改
    public function update() {
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
                $res = M('record')->where($where)->find();
                //file01 判断
                if($_POST['file011'] == 2){
                    //如果等于2，新上传图片
                    $file01 =  "/Uploads/" . $info['file01']['savepath'] . $info['file01']['savename'];
                    $filename=$_SERVER['DOCUMENT_ROOT'].$file01;
                    $image = new CImage();
                    $image->CreateThumbnail($filename, 300, 300, $toFile="");
                }elseif($_POST['file011'] == 1) {
                    //如果等于1，删除原图片
                    $file01 = "";
                }elseif($_POST['file011'] == 0) {
                    //如果等于0，保存原图片
                    $file01 = $res['main_img'];
                }
                $data['main_img'] = $file01;

                if($_POST['file012'] == 2){
                    //如果等于2，新上传图片
                    $file02 =  "/Uploads/" . $info['file02']['savepath'] . $info['file02']['savename'];

                    $image = new CImage();
                    $filename=$_SERVER['DOCUMENT_ROOT'].$file02;
                    $image->CreateThumbnail($filename, 300, 300, $toFile="");

                }elseif($_POST['file012'] == 1) {
                    //如果等于1，删除原图片
                    $file02 = "";
                }elseif($_POST['file012'] == 0) {
                    //如果等于0，保存原图片
                    $file02 = $res['main_img'];
                }
                $data['id_img'] = $file02;
            }
            $data['id_img1'] = "/Uploads/" . $info['file02']['savepath'].time().'.jpg';
            //print_r($data); exit;
            $data['username'] = $_GET['username'];
            $data['tel'] = $_REQUEST['tel'];
            $data['title'] = $_REQUEST['title'];
            $data['email'] = $_REQUEST['email'];
            $data['address'] = $_REQUEST['address'];
            $where['id'] = $_REQUEST['id'];
            $data['name'] = $_REQUEST['name'];
            // $data['class_id'] = $_REQUEST['news_class'];
            $data['edit_date'] = time();
            if($_REQUEST['id']){
                $res =M('record')
                    ->where($where)
                    ->data($data)
                    ->save();
                if($res){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/update',array('id'=>$_REQUEST['id'],'username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                    exit;
                }else{
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/update',array('id'=>$_REQUEST['id'],'username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                    exit;
                }

            }else{
                $res =M('record')
                    ->data($data)
                    ->add();
                if($res){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/update',array('id'=>$res,'username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                    exit;
                }else{
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/update',array('id'=>$res,'username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                    exit;
                }
            }
        }
        $where['id'] = $_REQUEST['id'];
        $res = M('record')->where($where)->find();
        //$filename=$res['main_img'];
        //输出当前产品信息
        $this->assign('list',$res);
        $this->display();
    }

    //主页修改
    public function xieyi() {
        $list = M('record_xieyi')->find();
        $this->assign('info',$list);
        $this->display();
    }
}


