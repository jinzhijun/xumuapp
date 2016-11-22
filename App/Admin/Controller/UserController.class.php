<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class UserController extends BaseController {
    public $user;
    public function _initialize(){
        parent::_initialize();
        $this->user = D('User');

    }
    //首页列表，条件搜索
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
        $res = $this->user->Getlist($where,"*","id ASC",$page->firstRow.','.$page->listRows);
        foreach($res as $k=>$v){
            $userid[] = $v['grade_id'];
        }
        if( empty($userid) ){
        	$grade = D("UserGrade")->GetList();
        }else{
        	$grade = D("UserGrade")->GetList(array("id"=>array('in',$userid)));
        }
        foreach($res as $res_k=>$res_v){
            foreach ($grade as $grade_v) {
                if ($res_v['grade_id'] == $grade_v['id'] ){
                    $res[$res_k]['grade'] = $grade_v['name'];
                }
            }
        }
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->display();
    }
   //删除
    public function previous_delete(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->user->user_del(array('id'=>$v));
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
    //
    public function password(){
        if($_REQUEST['id'] == ''){
            exit;
        }
        //查询当前用户数据集
        $where['id'] = $_REQUEST['id'];
        $res = $this->user->where($where)->find();
        $this->assign('list',$res);
       $this->display();
    }
    public function head_save(){
    	if($_REQUEST['id'] == ''){
    		exit;
    	}
    	$where['id'] = $_REQUEST['id'];
    	
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
    	$res = $this->user->where($where)->find();
    	$this->assign('list',$res);
    	$this->display();
    }
    //ajax change事件 检查旧密码
    public function check_old_password(){
        if($_POST['id'] !== ''){
        	$old_v = md5(md5(I('old_password')));
        	$where = array();
            $where['id'] = $_REQUEST['id'];
            $res = $this->user->Getone($where);
            $old_pass = $res['password'];
	        if($old_pass == $old_v){
                $json['result'] = 'success';
            }else{
                $json['result'] = 'error';
            }
            $this->ajaxReturn($json);
        }else{
            exit;
        }       
    }
    //修改密码
    public function save_password(){
        if($_POST['id'] !== ''){
            $where = array();
            $data = array();
            $where['id'] = $_REQUEST['id'];
            $data['password'] = md5(md5(I('password')));
            $data['edit_date'] = time();
            $res = $this->user->Saveuser($where,$data);
            if($res != false){
                $json['result'] = 'success';
            }else{
                $json['result'] = 'error';
            }
            $this->ajaxReturn($json);
        }else{
            exit;
        }
    }
    //设置新密码
    public function set_new_pass(){
        if($_POST['id'] !== ''){
            if($_REQUEST['confirm_password']){
                 $where = array();
                 $data = array();
                 $where['id'] = $_REQUEST['id'];
                 $data['password'] = md5(md5($_REQUEST['confirm_password']));
                 $data['pass_initialize'] = 1;
                 $data['edit_date'] = time();
                 $res = $this->user->Saveuser($where,$data);
                 if($res){
                    $json['result'] = 'success';
                 }
                 }else{
                      $json['result'] = 'error';
                 }
            $this->ajaxReturn($json);
        }else{
            exit;
        }
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
            $res = $this->user->Saveuser($where,$data);
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
        $this->UserGrade();
        $res = $this->user->Getone($where);
        $this->assign('list',$res);
        $this->display('add');
    }


    //是否启用
    public function sign_change(){
        $where['id'] = $_REQUEST['id'];
        $add_score = (int)$_REQUEST['add_score'];
        $res= M('user')->where($where)->setInc('total_score',$add_score);
        if($res){
            $info['username']= I('post.username');
            $info['sign']= $add_score;
            $info['date']= time();
            $info['type']= $_POST['type'];//积分手动添加
            M('sign')->add($info);
            $arr['status']= 1;
            $arr['info']= '添加成功';
            echo json_encode($arr); exit;
        }else{
            $arr['status']= 0;
            $arr['info']= '添加失败';
            echo json_encode($arr); exit;
        }
    }



    //是否启用
    public function show_change(){  
        $where['id'] = $_REQUEST['id'];
        $data['status'] = $_REQUEST['status'];
        $res = $this->user->Saveuser($where,$data);
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
            $this->user = D('User');
        	$arr=array();
            while(count($arr)<10)
            {
                $arr[]=rand(1,10);
                $arr=array_unique($arr);
            }
            $a= implode("",$arr);
            $b = substr($a,5);
            $data['sex'] = $_REQUEST['sex'];
            $data['pass_text'] = $b;
            $data['mobile'] = I('mobile');
            $data['truename'] = I('truename');
            if(I('name')){
                $findone = $this->user->where(array('name'=>I('name')))->find();
                if(!empty($findone)){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('已有的用户名，请重新输入！');</script>";
                    $this->UserGrade();
                    $this->display();
                    exit;
                }else{
                    $data['name'] = I('name');
                }
            }
           $data['grade_id'] = I('news_class');
            $data['sort'] = I('sort');
            $data['status'] = I('status') == true ? 1:0;;
            $data['date'] = time();
         if($this->user->create($data)){
           if($this->user->add()){
            		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            		echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            	}else{
            		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            		echo "<script>alert('操作失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            	}
            	}else{
             $error = $this->user->getError();
             echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
             echo "<script>alert('$error');</script>";

           }
        }
        $this->UserGrade();
        $this->display();
    }
    //查询会员等级
    public function UserGrade(){
        $user_grade = D("UserGrade")->GetList(array("status"=>1));
        $this->assign("UserGrade",$user_grade);
    }
   
}