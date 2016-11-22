<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class HospController extends BaseController {
    public $user;
    public function _initialize(){
        parent::_initialize();
        $this->user = M('hosp_class');
    }
    public function index(){
        $where = "";
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
         
        $count = $this->user->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->user->where($where)
        ->order('sort ASC')
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->display();
    }
    public function search(){
         
        $where['name'] = array("like", "%" . I('get.name') . "%");
        $res = $this->user->where($where)
        ->order('sort ASC')
        ->select();
        $this->assign('list',$res);
        $this->display('list_previous');
    }
    public function list_previous(){
        $name = I('name');
        if($name){
           $where['name'] = array("like","%".$name."%");
        } 
         
        $count = $this->user->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->user->where($where)
        ->order('sort ASC')
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->display();
    }
    public function previous_delete(){
        
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->user->where(array('id'=>$v))->delete();
               if($res){
                   $json['result'] = 'success1';
               }
               else{
                   $json['result'] = 'error';
               }
           }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->user->where($where)->delete();
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
         }
        $this->ajaxReturn($json);
     }
    public function previous_save() {
        $where['id'] = I('id');
        $data['name'] = I('name');
        $data['sort'] = I('sort');
        $data['status'] = I('status')?1:0;
        $data['date'] = time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =     ''; // 设置附件上传（子）目录
    	// 上传文件
    	$info=$upload->upload();
    	if($_REQUEST['ifuploadback_zizhi'] == 1){
        	$data['h_thumb'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];
        }
        $res = $this->user->where($where)->data($data)->save();
        if($res == true){
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			echo "<script>alert('修改成功');window.location.href=\"".U('Hosp/index')."\";</script>";exit;
		}else{
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			echo "<script>alert('".$this->user->getError()."修改失败')";exit;
		}
    }
    
    public function add_hospital() {
        $where['id'] = I('id');
        $data['name'] = I('name');
        $data['sort'] = I('sort');
        $data['status'] = I('status')?1:0;
        $data['date'] = time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =     ''; // 设置附件上传（子）目录
    	// 上传文件
    	$info=$upload->upload();
    	if($_REQUEST['ifuploadback_zizhi'] == 1){
        	$data['h_thumb'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];
        }
        $res = $this->user->where($where)->add($data);
        if($res == true){
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			echo "<script>alert('添加成功');window.location.href=\"".U('Hosp/index')."\";</script>";exit;
		}else{
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			echo "<script>alert('".$this->user->getError()."添加失败')";exit;
		}
    }
    
    public function save_data() {
        
        $where['id'] = $_REQUEST['id'];
        $res = $this->user->where($where)->find();
        $this->assign('list',$res);
        $this->display('_add');
    }
    public function show_change(){  
         $res = $this->user
         ->where(array('id' => $_REQUEST['id']))
         ->save(array('status'=>$_REQUEST['status']));
    }
    public function _add(){
        $this->display();
    }
    public function add_data(){
       // $data['sex'] = $_REQUEST['sex'];
      //  $data['birthday'] = $_REQUEST['birthday'];
       // $data['mobile'] = $_REQUEST['mobile'];
       // $data['truename'] = $_REQUEST['truename'];
        $data['name'] = $_REQUEST['name'];
        $data['sort'] = $_REQUEST['sort'];
        $data['status'] = I('status') == true ? 1:0;;
        $data['date'] = time();
        $res = $this->user->data($data)->add();
        if($res){
            $json['result'] = 'success';
        }
        else{
            $json['result'] = 'error';
        }
        $this->ajaxReturn($json);
    }
}