<?php
/**
 * 
 * User: 
 * Date: 
 * Time: 
 */

namespace Admin\Controller;
use Common\ORG\Util\Page;
use Think\Model;

class NewsController extends BaseController
{
    //控制器初始化
    function _initialize(){
        $this->Model = D('News');
    }
    //首页
    public function index(){
        $where = '';
        $title = I('title');
        if($title){
            $where['title'] = array("like","%".$title."%");
        }
        $count = $this->Model->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res =$this->Model->order('id desc')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
        foreach($res as $k=>$v){
            $newsclass = D('Newsclass')->getone(array('id'=>$v['class']));
            $res[$k]['class']= $newsclass['name'];
        }
        $this->assign('page', $page->show());
        $this->assign('title',$title);
        $this->assign('list',$res);
        $this->display();
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
    //产品编辑
    public function edit(){
        if($_POST) {
           if(I('title') == ''){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('请输入标题');</script>";
                exit;
            }else{
                $data['title'] = trim(I('title'));
            }
            if(I('editor_notice') == ''){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('请输入内容');</script>";
                exit;
            }else{
                $data['content'] = I('editor_notice');
            }
            $data['sort'] = I('sort')?I('sort'):0;
            $data['class'] = I('class');
            $data['status'] = I('status');
            $data['description'] = I('description');
            $data['update_time'] = time();
            $where['id'] = I('id');
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
        $where = array();
        $where['id'] = $_REQUEST['id'];
        $res = $this->Model->where($where)->find();
        $this->assign('list',$res);
        $this->display('add');
    }

    //创建新产品
    public function add(){
        if($_POST){
            if(I('title') == ''){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('请输入标题');</script>";
                exit;
            }else{
                $data['title'] = trim(I('title'));
            }
            if(I('editor_notice') == ''){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('请输入内容');</script>";
                exit;
            }else{
                $data['content'] = I('editor_notice');
            }
            $data['sort'] = I('sort')?I('sort'):0;
            $data['class'] = I('class');
            $data['status'] = I('status');
            $data['description'] = I('description');
            $data['create_time'] = time();
            $res = $this->Model->add($data);
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
        $this->display();
    }
    //推送
    function push(){
		require_once './App/push_api/sdk.php';
		// 创建SDK对象.
		if( 'Android' == $machine_type ){
			$sdk = new PushSDK('G9k9pV6NluppGVT5AtZBbSlm','X6POWiS2zCNCeuHCo539PfnVnAwp6Gyu');
			// 设置消息类型为 通知类型.
			$opts = array (
		    	'msg_type' => 1,
			);
			$message = array (
			    // 消息的标题.
			    'title' => '【递国之道】',
			    // 消息内容 
			    'description' => "您有一条新消息",
			    "custom_content"=>array(
			    						'new_id'=>I('id'),
			    					), 
			);
		}elseif( 'ios' == $machine_type ){
			$sdk = new PushSDK('FSPxg7abGm93xGzBQK5sxY66','41MzGjjPWHoSZhw6yj1bUhtqpigArwpk');
			// 设置消息类型为 通知类型.
			$opts = array (
			    'msg_type' => 1,        // iOS不支持透传, 只能设置 msg_type:1, 即通知消息.
			    'deploy_status' => 1,   // iOS应用的部署状态:  1：开发状态；2：生产状态； 若不指定，则默认设置为生产状态。
			);
			$message = array (
			    'aps' => array (
			        // 消息内容
			        'alert' => "您有一条新消息", 
			    ), 
			    'new_id'	=> I('id'),
			);
		}

		// 向目标设备发送一条消息
		//$rs = $sdk -> pushMsgToSingleDevice($channelId, $message, $opts);
		$rs = $sdk -> pushMsgToAll($message, $opts);

		// 判断返回值,当发送失败时, $rs的结果为false, 可以通过getError来获得错误信息.
		if($rs === false){
			return 2;
			//print_r($sdk->getLastErrorCode()); 
		    //print_r($sdk->getLastErrorMsg()); exit;
		}else{
			return 1;
			//print_r($rs);
		}
	}
}