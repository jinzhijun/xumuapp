<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class ProClassController extends BaseController {
    public $previous;
    public function _initialize(){
        parent::_initialize();
        //模型初始化
        $this->previous = D('ProClass');
    }
    //首页
    public function index(){
        $where = "";
        $name = I('name');
        //搜索
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->previous->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->previous->where($where)
            ->order('id ASC')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //视图展示数据集
        $this->assign('page', $page->show());
        $this->assign('name',$name);
        $this->assign('list',$res);
        $this->display();
    }
    //删除
    public function delete_data(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->previous->where(array('id'=>$v))->delete();
               if($res){
                   $json['result'] = 'success1';
               }
               else{
                   $json['result'] = 'error';
               }
           }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->previous->where($where)->delete();
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
         }
        $this->ajaxReturn($json);
     }
    //修改
    public function save_data() {
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
              $res = $this->previous->where($where)->find();
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
          $where['id'] = I('id');
          $data['name'] = $_REQUEST['name'];
          $data['sort'] = $_REQUEST['sort'];
          $data['date'] = time();
          if($this->previous->create()){
              if($this->previous->where($where)->save($data)){
                  echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                  echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
              }else{
                  echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                  echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
              }
          }
          else{
              $this->error($this->previous->getError());
          }
      }
        $where['id'] = $_REQUEST['id'];
        $res = $this->previous->where($where)->find();
        $this->assign('list',$res);
        $this->display('add');
    }
    //修改状态
    public function show_change(){  
         $res = $this->previous
         ->where(array('id' => $_REQUEST['id']))
         ->save(array('status'=>$_REQUEST['status']));
    }
    //添加
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
                $res = $this->previous->where($where)->find();
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


            $data['name'] = $_REQUEST['name'];
            $data['sort'] = $_REQUEST['sort'];
            $data['date'] = time();
            if($this->previous->create($data)){
                if($this->previous->pc_add()){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
                }else{
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
                }
            }
            else{
                 $error = $this->previous->getError();
                 echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                 echo "<script>alert('$error');</script>";

            }
        }
        $this->display();
    }
}