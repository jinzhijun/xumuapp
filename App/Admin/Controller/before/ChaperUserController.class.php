<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class ChaperUserController extends BaseController {
    public $user;
    public function _initialize(){
        parent::_initialize();
        $this->user = D('Accompany');
    }
    //用户首页
    public function index(){
    	$where = "";
    	$count = $this->user->where($where)->count();
    	$page = new Page($count,10);
		
		$list = $this->user->where($where)
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        
		$this->assign('list',$list);
		$this->assign('page', $page->show());
      	$this->display();
    }
    
    //按条件搜索
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
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        $this->assign('page', $page->show());
        $this->assign('name',$name);
        $this->assign('list',$res);
        $this->display('ChaperUser/index');
    }
    
    //删除用户
    public function previous_delete(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
             	$res = $this->user->user_del(array('id'=>$v));
               if( !$res ){
                $json['result'] = 'error';break;
               }
           }
           		$json['result'] = 'success';
        }else{
        	$where = array();
            $where['id'] = $_REQUEST['id'];
            $res = $this->user->user_del($where);
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
         }
        $this->ajaxReturn($json);
     }
     
     
    /*修改用户*/
    public function save_user() {
        if( I('change') == 'ok' ){
        	$where = array();
        	$data = array();
        	$where['id'] = $_REQUEST['id'];
     	    $upload = new \Think\Upload();// 实例化上传类
        	$upload->maxSize   =     3145728 ;// 设置附件上传大小
        	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        	$upload->savePath  =     ''; // 设置附件上传（子）目录
        	// 上传文件
        	$info=$upload->upload();
        	if($_REQUEST['ifuploadback_zizhi'] == 1){
            	$data['head'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];
            }	
            $data['acc_id'] = I('acc_id');
            $data['name'] = I('name');
            $data['mobile'] = I('mobile');
         	$data['sex'] = I('sex') ;
        	$data['birthtime'] = strtotime(I('birthtime'));
    		$data['updatetime'] = time();
    		$res = M('accompany')->where($where)->data($data)->save();
    		if($res == true){
    			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    			echo "<script>alert('修改成功');window.location.href=\"".U('ChaperUser/index')."\";</script>";exit;
    		}else{
    			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    			echo "<script>alert('".$this->user->getError()."修改失败')";exit;
    		}
    		
    	}
        $where['id'] = $_REQUEST['id'];
        $res = $this->user->Getone($where);
        $this->assign('list',$res);
        $this->display('add_user');
    }
    
    /*添加用户*/
    public function add_user(){
    	if($_POST){
    		if($this->user->create()){
    			$this->user->birthtime = strtotime($this->user->birthtime);
    			$this->user->addtime = time();
    			if($this->user->add()){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    				echo "<script>alert('新增成功');window.location.href=\"".U('ChaperUser/index')."\";</script>";exit;
				}else{
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
					echo "<script>alert('".$this->user->getError()."新增失败');window.location.href=\"".U('ChaperUser/add_user')."\";</script>";exit;
				}
    		}else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    			echo "<script>alert('".$this->user->getError()."新增失败');window.location.href=\"".U('ChaperUser/add_user')."\";</script>";exit;
    		}
    	}
    	$this->display();
    }
    
    //查看陪诊人员信息
    public function info(){
    	$where['id'] = I('id');
        $res = $this->user->Getone($where);
        $this->assign('list',$res);
        $this->display();
    }

}