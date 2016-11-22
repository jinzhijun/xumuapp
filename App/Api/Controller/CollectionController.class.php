<?php
namespace Api\Controller;
use Think\Controller;
class CollectionController extends Controller {
	
	const size = "1";
	
    //收藏接口
    public function collect(){
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
		$r_id = I("r_id")?I("r_id"):exit(res("请传入直播间id",2));
		$user_model = D('User');
		$user_condition = array(
			'user_id'	=>	$user_id,
		);
		$user_info = $user_model->Getone($user_condition);
		if( $user_info ){
			$room_arr = explode(",",$user_info['live_room']);
			foreach( $room_arr as $v ){
				if( $v == $r_id){
					exit(res("已收藏",2));
				}
			}
			array_push($room_arr,$r_id);
			$room_str = implode(",",$room_arr);
			$save_data = array(
				'live_room'	=>	$room_str,
			);
			$user_result = $user_model->Saveuser($user_condition,$save_data);
			if( $user_result ){
				exit(res("收藏成功",1));
			}else{
				exit(res("收藏失败",2));
			}
		}else{
			exit(res("请传入正确用户名",2));
		}
    }
    
    //检查是否已收藏
    public function collect_check(){
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
		$r_id = I("r_id")?I("r_id"):exit(res("请传入直播间id",2));
		$user_model = D('User');
		$user_condition = array(
			'user_id'	=>	$user_id,
		);
		$user_info = $user_model->Getone($user_condition);
		if( $user_info ){
			foreach(explode(",",$user_info['live_room']) as $v){
				if( $v == $r_id){
					return 1;
				}
			}
			return 2;
		}else{
			return 2;
		}
    }
    //收藏列表
    public function collect_list(){
    	$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
    	$page = I("page")?I("page"):1;
    	$user_model = D('User');
		$user_condition = array(
			'user_id'	=>	$user_id,
		);
		$user_info = $user_model->Getone($user_condition);
		if( $user_info ){
			//$room_arr = explode(",",$user_info['live_room']);
			if( $room_arr ){
				$live_model = D('Liveroom');
				$live_condition = array(
					'id' => array('in',$user_info['live_room']),
				);
				$sum = $live_model->where($condition)->count();
				$live_list = $live_model->Getlist($live_condition,"",'id asc',self::size,$page);
				$countpage = ceil($sum/self::size);
				if( $countpage > $page ){
					$tip = "have";
				}else{
					$page = $countpage;
					$tip = "no";
				}
				//print_r($live_list);exit;
				//最终结果
				$item =array(
					'tip'=>$tip,
					'info'=>$live_list
				);
				exit(json_encode($item));
			}else{
				
			}
		}else{
			exit(res("请传入正确用户名",2));
		}
    }
    
}