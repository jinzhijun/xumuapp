<?php
namespace Api\Controller;
use Think\Controller;
class ScheduleController extends Controller {
	
	const size = "10";
	
	//排程列表接口 
	//http://192.168.0.99:8090/api.php?m=api&c=schedule&a=getlist
	public function getlist(){
		$tip = "";
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
		$page = I('page')?I('page'):1;
		$starttime = I('time')?strtotime(I('time')):strtotime(date("Y-m-d",time()));
		$nowtime = $starttime + (60*60*24);
		
		$accorder_model = D('accorder');
		$condition = array();
		$condition['user_id'] = $user_id;
		$condition['state'] = array('between','2,3.9');
		$condition['time'] = array('between',array($starttime,$nowtime));
		$sum = $accorder_model->where($condition)->count();
		$countpage = ceil($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		//获取医院信息
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->field('id,name,date')->select();
		//获取排程信息
		$result = $accorder_model->Getlist($condition,"id,user_id,acc_id,acc_start_time,acc_end_time,hospital,create_time,place,time",self::size,$page);
		$acc_model = M('accompany');
		foreach( $result as $kk=>$vv ){
			$result[$kk]['acc_start_time'] = date('H:i',$vv['acc_start_time']);
			$result[$kk]['acc_end_time'] = date('H:i',$vv['acc_end_time']);
			//获取陪护人员头像
			$acc_info = $acc_model->where(array('acc_id'=>$vv['acc_id']))->field('head')->find();
			$result[$kk]['head'] = $acc_info['head']?"http://".$_SERVER['HTTP_HOST'].$acc_info['head']:"";
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result[$kk]['hospital']){
					$result[$kk]['hospital'] = $hv['name'];break;
				}
			}
		}
		//获取排程有那些具体日期
		$result_arr = $accorder_model->Getlist(array('state'=>array('between','2,3.9'),'user_id'=>$user_id,),"id,user_id,acc_start_time,acc_end_time,create_time,hospital,time,place");
		$result_str = array();
		foreach( $result_arr as $k => $v ){
			$result_str[$k] =date("Y-m-d",$v['time']);
		}
		//最终结果
		$item =array(
			'tip'=>$tip,
			'info'=>array(
				'pretime' => $result_str,
				'list'	=>	$result
			),
		);
		exit(json_encode($item));
	}7
	
	//排程详情接口
	//http://192.168.0.99:8090/api.php?m=api&c=schedule&a=getinfo&id=1
	public function getinfo(){
		$id = I("id")?I("id"):exit(res("请传入排程id",2));
		$accorder_model = D('accorder');
		$where = array();
		$where['id'] = $id;
		$order_info = $accorder_model->Getone($where);
		if( !$order_info ){
			exit(res("不存在此排程",2));
		}
		$accoperation_model = D('accoperation');
		$acc_condition = array();
		$acc_condition['order_id'] = $id;
		$oper_info = $accoperation_model->Getone($acc_condition);
		if( $oper_info ){
			$order_info['info_visit'] = $oper_info['info_visit'];
			$order_info['info_diagnosis'] = $oper_info['info_diagnosis'];
			$order_info['illness'] = $oper_info['illness'];
			$order_info['memo'] = $oper_info['memo'];
			$order_info['price'] = $oper_info['price'];
		}
		$item =array(
			'tip'=>"",
			'info'=>$order_info,
		);
		exit(json_encode($item));
	}
	
	
	
	
	
	
	
}