<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
use Common\ORG\Util\Serverapi;
use Common\ORG\Util\Video;
class LiveroomController extends BaseController {
    public function _initialize(){
        parent::_initialize();
        $this->live = D('Liveroom');
    }
    //首页列表，条件搜索
    public function index(){
        $where = "";
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->live->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->live->Getlist($where,"*","id ASC",$page->firstRow.','.$page->listRows);
        
        $grade = D("Liveclass")->GetList();

        foreach($res as $res_k=>$res_v){
            foreach ($grade as $clss_v) {
                if ($res_v['live_class'] == $clss_v['id'] ){
                    $res[$res_k]['live_class'] = $clss_v['name'];
                }
            }
        }
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->display();
    }
   //删除
    public function previous_delete(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->live->user_del(array('id'=>$v));
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
            //查询直播间详情
            $liveinfo = $this->live->Getone($where);
            //删除直播间
            $post_data = json_encode(array ("cid"=>$liveinfo['cid']));
			$curlpush = new Video("https://vcloud.163.com/app/channel/delete",$post_data);
			$videoresult = $curlpush->CurlSend();
            if($videoresult['code'] != 200){
            	$json['result'] = 'error';
            	$this->ajaxReturn($json);die();
            }
            //删除聊天室
            $Serverapi = new Serverapi();
			$ret = $Serverapi->chatroomDestroy($liveinfo['room_id']);
			$ret = json_decode($ret,true);
			if($ret['code'] != 200){
        		$json['result'] = 'error';
            	$this->ajaxReturn($json);die();
			}
			
            $res = $this->live->live_del($where);
            if(!$res){
            	$json['result'] = 'error';
            }else{
            	$this->talk = D('Talkroom');
            	$talk_where = array('talk_id' => $liveinfo['room_id'],);
            	$talkres = $this->talk->Talk_del($talk_where);
				if($talkres){
	                $json['result'] = 'success';
	            }else{
	                $json['result'] = 'error';
	            }
            }
         }
        $this->ajaxReturn($json);
     }
    //头像上传
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
    	$res = $this->live->where($where)->find();
    	$this->assign('list',$res);
    	$this->display();
    }
    //ajax change事件 检查旧密码
    public function check_old_password(){
        if($_POST['id'] !== ''){
        	$old_v = md5(md5(I('old_password')));
        	$where = array();
            $where['id'] = $_REQUEST['id'];
            $res = $this->live->Getone($where);
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
            $res = $this->live->Saveuser($where,$data);
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
        $this->liveGrade();
        $res = $this->live->Getone($where);
        $this->assign('list',$res);
        $this->display('add');
    }
    //是否启用
    public function show_change(){  
        $where['id'] = $_REQUEST['id'];
        $data['is_lock'] = $_REQUEST['status'];
        $res = $this->live->Savelive($where,$data);
    }

    //添加
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
            if(I('room_id')){
                $findone = $this->live->where(array('room_id'=>I('room_id')))->find();
                if(!empty($findone)){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('已有的用户名，请重新输入！');</script>";
                    $this->display();
                    exit;
                }else{
                    $data['room_id'] = I('room_id');
                }
            }
            $data['name'] = I('name')?I('name'):"匿名";
           	$data['description'] = I('description');
           	$data['live_class'] = I('live_class');
           	$data['memo'] = I('memo');
            $data['sort'] = I('sort');
            $data['is_lock'] = I('is_lock');echo I('live_class');exit;
            $data['type'] = I('type');
            $data['create_user'] = $_COOKIE[account];
            $data['create_time'] = time();
            
            //创建直播间
       		$post_data = json_encode(array ("name" => I('room_id'),"type" =>I('type')));
       		$Video = new Video("https://vcloud.163.com/app/channel/create",$post_data);
       		$sendresult = $Video->CurlSend();
        	if($sendresult['code'] != 200){
        		//throw new \Exception('远程创建直播间失败');
        		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	        	echo "<script>alert('远程创建直播间失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
			}
			$data['cid'] = $sendresult['ret']['cid'];
			//创建聊天室
			$Serverapi = new Serverapi();
			$ret = $Serverapi->chatroomCreate(array($data['room_id']=>$data['room_id']));
			$ret = json_decode($ret,true);
			if($ret['code'] != 200){
        		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	        	echo "<script>alert('远程创建聊天室失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
			}
            try{
            	$this->live = D('Liveroom');
            	$this->talk = D('talkroom');
            	$this->live->startTrans();
				if($this->live->create($data)){
					$livenum = $this->live->add();
					if( $livenum ){
						$livedata = array(
							'bind_liveroom' => $livenum,
							'create_user'	=> $_COOKIE[account],
							'name'			=> $data['name'],
							'talk_id'		=> $data['room_id'],
							'create_time'	=> time(),
						);
						if($this->talk->create($livedata)){
								if(!($this->talk->add())){
									throw new \Exception('聊天室创建失败');
								}
							}else{
								throw new \Exception('聊天室数据实例化失败');
							}
					}else{
						throw new \Exception('直播间创建失败');
					}
				}else{
					throw new \Exception('数据实例化失败');
				}
				$this->live->commit();
            }catch(\Exception $e){
            	$this->live->rollback();
            	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	        	echo "<script>alert('".$e->getMessage()."');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            }
            /*
            //创建直播间
       		$post_data = json_encode(array ("name" => I('name'),"type" => 0));
       		$Video = new Video("https://vcloud.163.com/app/channel/create",$post_data);
       		$sendresult = $Video->CurlSend();
        	if($sendresult['code'] != 200){
        		//throw new \Exception('远程创建直播间失败');
        		.
        		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	        	echo "<script>alert('远程创建直播间失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
			}
			//创建聊天室
			$Serverapi = new Serverapi();
			$ret = $Serverapi->chatroomCreate(array($data['room_id']=>$data['room_id']));
			$ret = json_decode($ret,true);
			if($ret['code'] != 200){
        		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	        	echo "<script>alert('远程创建聊天室失败');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
			}
			*/
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	        echo "<script>alert('操作成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
        }
        $this->liveGrade();
        $this->display();
    }
    public function liveGrade(){
    	$Liveclass = D("Liveclass")->GetList(array("status"=>1));
        $this->assign("Liveclass",$Liveclass);
    }
    //获取地址
    public function get_url(){
    	 $where = array();
        $where['id'] = I('id');
        //查询直播间详情
        $liveinfo = $this->live->Getone($where);
    	$post_data = json_encode(array ("cid"=>$liveinfo['cid']));
		$curlpush = new Video("https://vcloud.163.com/app/address",$post_data);
		$url_info = $curlpush->CurlSend();
		$this->assign('url_info',$url_info);
		$this->assign('liveinfo',$liveinfo);
		$this->display();
    }
   
}