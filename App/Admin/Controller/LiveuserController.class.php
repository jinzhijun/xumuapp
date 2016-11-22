<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class LiveuserController extends BaseController {
    public function _initialize(){
        parent::_initialize();
        $this->liveuser = D('Liveuser');

    }
    //首页列表，条件搜索
    public function index(){
        $where = "";
        $truename = I('truename');
        if($truename){
            $where['truename'] = array("like","%".$truename."%");
        }
        $count = $this->liveuser->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->liveuser->Getlist($where,"*","id ASC",$page->firstRow.','.$page->listRows);
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('truename',$truename);
        $this->display();
    }
   //删除
    public function previous_delete(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->liveuser->user_del(array('id'=>$v));
               if($res){
                   $json['result'] = 'success1';
               }
               else{
                   $json['result'] = 'error';
               }
           }
        }else{
            $where = array();
            $where['id'] = $_REQUEST['id'];
            $res = $this->liveuser->user_del($where);
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
         }
        $this->ajaxReturn($json);
     }
    //用户头像上传
    public function head(){
    	if($_REQUEST['id'] == ''){
    		exit;
    	}
    	$where['id'] = $_REQUEST['id'];
    	if(I('change') == 'change'){
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    		$upload->savePath  =     ''; // 设置附件上传（子）目录
    		// 上传文件
    		$info=$upload->upload();
    		 
    		if($info){
    			$imgdata['head'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];
    			$imgup = M("user")->where($where)->data($imgdata)->save();
    			if($imgup){
    				echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    				echo "<script>alert('操作成功');window.location.href=\"".U( CONTROLLER_NAME . '/index')."\";</script>";exit;
    			 
    			}else{
    				echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    				echo "<script>alert('操作失败');window.location.href=\"".U( CONTROLLER_NAME . '/index')."\";</script>";exit;
    				
    			}
    		}
    	}
    	//查询当前用户数据集
    	$res = $this->liveuser->where($where)->find();
    	$this->assign('list',$res);
    	$this->display();
    }
    
    //修改数据
    public function save_data() {
       if($_REQUEST['id'] == ''){
            exit;
        }
        if($_POST){
        	$upload = new \Think\Upload();// 实例化上传类
        	$upload->maxSize   =     3145728 ;// 设置附件上传大小
        	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        	$upload->savePath  =     ''; // 设置附件上传（子）目录
        	// 上传文件
        	$info=$upload->upload();
        	$where = array();
            $data = array();
            if($_REQUEST['ifuploadback_zizhi'] == 1){
            	$data['head'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];
            }	
            $data['sex'] = $_REQUEST['sex'];
            $data['birthday'] = strtotime($_REQUEST['birthday']);
            $where['id'] = $_REQUEST['id'];
            $data['mobile'] = $_REQUEST['mobile'];
            $data['truename'] = $_REQUEST['truename'];
            $data['grade_id'] = $_REQUEST['news_class'];
            $data['sort'] = $_REQUEST['sort'];
            $data['status'] = I('status') == true ? 1:2;;
            $data['date'] = time();
            $res = $this->liveuser->Saveuser($where,$data);
	          if($res){
    				echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    				echo "<script>alert('操作成功');window.location.href=\"".U( CONTROLLER_NAME . '/index')."\";</script>";exit;
    			 
    			}else{
    				echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    				echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
    				
    			}
        }
        $where = array();
        $where['id'] = $_REQUEST['id'];
        $res = $this->liveuser->Getone($where);
        $this->assign('list',$res);
        $this->display('add');
    }
    
    //是否启用
    public function show_change(){  
        $where['id'] = $_REQUEST['id'];
        $data['status'] = $_REQUEST['status'];
        $res = $this->liveuser->Saveuser($where,$data);
        if( $res ){
        	exit('1');
        }else{
        	exit('2');
        }
    }

    //添加用户
    public function add(){
        if($_POST){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info=$upload->upload();
            $where = array();
            $data = array();
            if($_REQUEST['ifuploadback_zizhi'] == 1){
                $data['head'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];
            }
            $data['user_id'] = I('user_id');
            $data['sex'] = I('sex');
            $data['mobile'] = I('mobile');
            $data['truename'] = I('truename');
            $data['sort'] = I('sort');
            $data['birthday'] = strtotime(I('birthday'));
            $data['status'] = I('status');
            $data['create_time'] = time();
         if($this->liveuser->create($data)){
           if($this->liveuser->add()){
            		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            		echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            	}else{
            		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            		echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            	}
            	}else{
             $error = $this->liveuser->getError();
             echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
             echo "<script>alert('$error');</script>";

           }
        }
        $this->display();
    }

   
}