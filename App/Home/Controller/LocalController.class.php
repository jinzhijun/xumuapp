<?php
namespace Home\Controller;
use Think\Controller;
class LocalController extends BaseController {
    public function index(){
        $user= M('user')->where(array('name'=>$_GET['username']))->find();
        $this->assign('user',$user);
        $list= M('local')->where(array('username'=>$_GET['username']))->select();
        //print_r($list); exit;
        $this->assign('list',$list);
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
                //file01 判断
                $filemain =  "/Uploads/" . $info['filemain']['savepath'] . $info['filemain']['savename'];
                $data['main_img'] = $filemain;

                $fileidr =  "/Uploads/" . $info['fileidr']['savepath'] . $info['fileidr']['savename'];
                $data['idr_img'] = $fileidr;


                $fileidl =  "/Uploads/" . $info['fileidl']['savepath'] . $info['fileidl']['savename'];
                $data['idl_img'] = $fileidl;


                $filestorer1 =  "/Uploads/" . $info['filestorer1']['savepath'] . $info['filestorer1']['savename'];
                $data['storer1_img'] = $filestorer1;


                $filestorer2 =  "/Uploads/" . $info['filestorer2']['savepath'] . $info['filestorer2']['savename'];
                $data['storer2_img'] = $filestorer2;


                $filestorel1 =  "/Uploads/" . $info['filestorel1']['savepath'] . $info['filestorel1']['savename'];
                $data['storel1_img'] = $filestorel1;


                $filestorel2 =  "/Uploads/" . $info['filestorel2']['savepath'] . $info['filestorel2']['savename'];
                $data['storel2_img'] = $filestorel2;


                $filestorel3 =  "/Uploads/" . $info['filestorel3']['savepath'] . $info['filestorel3']['savename'];
                $data['storel3_img'] = $filestorel3;

            }
            $data['username'] = $_GET['username'];
            $data['name'] = $_REQUEST['name'];
            $data['tel'] = $_REQUEST['tel'];
            $data['title'] = $_REQUEST['title'];

            $data['edit_date'] = time();
            $res =M('local')->data($data)->add();

            if($res){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }
        }
        $where['id'] = $_REQUEST['id'];
        $res = M('record')->where($where)->find();
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


