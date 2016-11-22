<?php
namespace Api\Controller;
use Think\Controller;
use Common\ORG\Util\Serverapi;
use Common\ORG\Util\Video;

class LiveroomController extends Controller {
	
	const size = "1";
	
	public function _initialize(){
        $this->live = D('Liveroom');
    }
    
	//直播间列表
	public function liveroom_list(){
		//$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
		$page = I("page")?I("page"):1;
		$liveroom_condition = array(
		//	'user_id'	=>	$user_id,
			'is_lock'	=>	'1',
		);
		//查询总量
		$sum = $this->live->where($condition)->count();
		$res = $this->live->Getlist($liveroom_condition,"*","id ASC",self::size,$page);
		$countpage = ceil($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		//最终结果
		$item =array(
			'tip'=>$tip,
			'info'=>$res
		);
		exit(json_encode($item));
	}
    
    //查询直播间详情
    public function liveroom_info(){
    	$id = I("id")?I("id"):exit(res("请传入直播间标识id",2));
    	$room_id = I("room_id")?I("room_id"):exit(res("请传入直播间标识",2));
    	$liveroom_condition = array(
    		'id'		=>	$id,
    		'room_id'	=>	$room_id,
    	);
    	$live_info = $this->live->Getone($liveroom_condition);
    	//查询直播间详情
    	$post_data = json_encode(array ("cid"=>$live_info['cid']));
		$curlpush = new Video("https://vcloud.163.com/app/address",$post_data);
		$live_address = $curlpush->CurlSend();
		//echo "<pre>";
		//print_r($live_address['ret']);exit;
		if( $live_address['code'] == '200' ){
			//查询聊天室信息
			$talk_condition = array(
				'bind_liveroom'	=>	$id,
			);
			$talk_model = D('Talkroom');
			$talk_info = $talk_model->Getone($talk_condition);
			if( $talk_info['talk_id'] ){
				//$Serverapi = new Serverapi();
				//$ret = $Serverapi->chatroomQuery($talk_info['talk_id']);
				//$ret = json_decode($ret,true);
				$res = array(
					'httpPullUrl'	=>	$live_address['ret']['httpPullUrl'],
					'hlsPullUrl'	=>	$live_address['ret']['hlsPullUrl'],
					'rtmpPullUrl'	=>	$live_address['ret']['rtmpPullUrl'],
					'pushUrl'		=>	$live_address['ret']['pushUrl'],
					'name'			=>	$live_info['name'],
					'talk_id'		=>	$talk_info['talk_id'],
				);
				//最终结果
				$item =array(
					'tip'=>'success',
					'info'=>$res
				);
				exit(json_encode($item));
			}else{
				exit(res("聊天室加载失败",2));
			}
		}else{
			exit(res("直播间加载失败",2));
		}
    }
    
}