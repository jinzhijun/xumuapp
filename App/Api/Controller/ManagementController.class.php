<?php
namespace Api\Controller;
use Think\Controller;
class ManagementController extends Controller {
	
	const size = "10";
	
	//病史记录列表接口 （这个接口需要改 是需要分出几个月的来还有计算每个月的数量）
	//http://192.168.0.99:8090/api.php?m=api&c=schedule&a=getlist
	/*public function ill_list(){
		$tip = "";
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
		$s_date = I('s_date')?I('s_date'):date("Y-m");
		$page = I('page')?I('page'):1;
		
		$t_date = explode("-",$s_date);
		if( $t_date['1']+1 > 12 ){
			$t_date['0'] += '1';
			$t_date['1'] = '1';
		}else{
			$t_date['1'] += '1';
		}
		$e_date = implode("-",$t_date);
		$starttime = strtotime($s_date);
		$endtime = strtotime($e_date);
		
		$accorder_model = D('accorder');
		$condition = array();
		$condition['user_id'] = $user_id;
		$condition['state'] = '3';
		$condition['time'] = array('between',array($starttime,$endtime));
		
		$sum = $accorder_model->where($condition)->count();
		$countpage = ($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		$result = $accorder_model->Getlist($condition,"id,user_id,acc_start_time,acc_end_time,hospital,place",self::size,$page);
		//获取医院信息
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->field('id,name,date')->select();
		foreach( $result as $kk=>$vv ){
			$result[$kk]['acc_start_time'] = date('H:i',$vv['acc_start_time']);
			$result[$kk]['acc_end_time'] = date('H:i',$vv['acc_end_time']);
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result[$kk]['hospital']){
					$result[$kk]['hospital'] = $hv['name'];break;
				}
			}
		}
		$item =array(
			'tip'=>$tip,
			'info'=>$result,
		);
		exit(json_encode($item));
	}*/
	public function ill_list(){
		$tip = "";
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
		$page = I('page')?I('page'):1;
		
		$Model = new \Think\Model();
		$allsql = "SELECT date_format(FROM_UNIXTIME(`time`),'%Y-%m') AS date,count(*) as count FROM `tp_accorder` WHERE user_id = '$user_id' AND state = 4 group by date_format(FROM_UNIXTIME(`time`),'%Y-%m') ORDER BY time DESC";
		$result_all = $Model->query($allsql);
		$sum = count($result_all);
		$countpage = ceil($sum/self::size)?ceil($sum/self::size):"1";
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		//医院
		$hospital = M('hosp_class');
		
		$start_sql = (($page-1)*(self::size));
		$page_size = self::size;
		$sql = "SELECT date_format(FROM_UNIXTIME(`time`),'%Y-%m') AS date,count(*) as count FROM `tp_accorder` WHERE user_id = '$user_id' AND state = 4 group by date_format(FROM_UNIXTIME(`time`),'%Y-%m') ORDER BY time DESC LIMIT $start_sql,$page_size";
		$result_acc = $Model->query($sql);
		$accorder_model = D('accorder');
		foreach( $result_acc as $k=>$v ){
			$t_date = explode("-",$v['date']);
			if( $t_date['1']+1 > 12 ){
				$t_date['0'] += '1';
				$t_date['1'] = '1';
			}else{
				$t_date['1'] += '1';
			}
			$e_date = implode("-",$t_date); 
			$starttime = strtotime($v['date']);
			$endtime = strtotime($e_date);
			$condition = array();
			$condition['user_id'] = $user_id;
			$condition['state'] = '4';
			$condition['time'] = array('between',array($starttime,$endtime));
			$result = $accorder_model->Getlist($condition,"id,user_id,type,acc_start_time,acc_end_time,hospital,time,place");
			foreach( $result as $kk=>$vv ){
				$hospital_result = $hospital->where(array('id'=>$vv['hospital']))->find();
				$result[$kk]['h_thumb'] = $hospital_result['h_thumb']?"http://".$_SERVER['HTTP_HOST'].$hospital_result['h_thumb']:"";
				$result[$kk]['type'] = $vv['type']?choosetype($vv['type']):"";
			}
			$result_acc[$k]['list'] = $result;
			unset($result);
		}
		
		$item =array(
			'tip'=>$tip,
			'info'=>$result_acc,
		);
		exit(json_encode($item));
	}
	
	
	//病史记录详情
	//http://192.168.0.99:8090/api.php?m=api&c=Management&a=ill_info&id=3
	public function ill_info(){
		$id = I("id")?I("id"):exit(res("请传入记录id",2));
		$accorder_model = D('accorder');
		$where = array();
		$where['id'] = $id;
		$where['state'] = '4';
		$order_info = $accorder_model->Getone($where);
		if( !$order_info ){
			exit(res("不存在此排程",2));
		}
		$user_model = D('user');
		$user_result = $user_model->Getone(array('name'=>$order_info['user_id']),'sex,birthday,head,ill');
		if( !$user_result ){
			exit(res("此记录有误",2));
		}
		$order_info['head'] = "http://".$_SERVER['HTTP_HOST'].$user_result['head'];
		$order_info['user_sex'] = $user_result['sex'];
		$order_info['birthday'] = $user_result['birthday']?date("Y-m-d",$user_result['birthday']):"无";
		$order_info['ill'] = $user_result['ill'];
		
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
			$order_info['t_imgs'] = explode(",",$oper_info['t_imgs']);
			$order_info['p_imgs'] = explode(",",$oper_info['p_imgs']);
		}else{
			$order_info['info_visit'] = "";
			$order_info['info_diagnosis'] = "";
			$order_info['illness'] = "";
			$order_info['memo'] = "";
			$order_info['price'] = "";
			$order_info['t_imgs'] = array();
			$order_info['p_imgs'] = array();
		}
		$item =array(
			'tip'=>"success",
			'info'=>$order_info,
		);
		exit(json_encode($item));
	}
	
	//任务查看接口
	public function task(){
		$accorder_model = D('accorder');
		$data = array();
		$acc_condition = array();
		if( I('schedule_id') ){
			$acc_condition['id'] = I('schedule_id');
		}elseif( I("user_id") ){
			$acc_condition['user_id'] = I("user_id");
			$acc_condition['state'] = array("egt",'1');
			$acc_condition['acc_start_time'] = array("elt",time());
			$acc_condition['acc_end_time'] = array("egt",time());
		}else{
			exit(res("请传入用户id或者排程id",2));
		}
		$info = $accorder_model->Getone($acc_condition);

		$user_model = D('user');
		$user_result = $user_model->Getone(array('name'=>$info['user_id']),'truename,sex,birthday,ill,head');
		if( !$user_result ){
			exit(res("无此用户",2));
		}
		$data['head'] = $user_result['head'];
		$data['truename'] = $user_result['truename'];
	
		if( $info ){
			if( $info['state']<= '2' || $info['state'] >'3.4' ){
				$info['state'] = '2';
			}
			$is = "have";
			$data['type'] = choosetype($info['type']);
			$data['place'] = $info['place'];
			$data['acc_time'] = $info['time']?date("Y-m-d h-i-s",$info['time']):"";
			$data['expert'] = $info['expert'];
			$data['state'] = $info['state'];
		}else{
			$is = "no";
			$data['type'] = "";
			$data['place'] = "";
			$data['acc_time'] = "";
			$data['expert'] = "";
			$data['state'] = "";
		}
		$item =array(
			'tip'=>$is,
			'info'=>$data,
		);
		exit(json_encode($item));
	}
	
	//服务提醒接口
	public function server_warn(){
		$tip = "";
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
		$page = I('page')?I('page'):1;
		$accorder_model = M('accorder');
		$nowtime = time();
		$result = $accorder_model->where("user_id = '$user_id' AND ((time >= '$nowtime' AND state =2) OR (  is_evaluation = 0 AND state =4 ))")->order('id desc')->limit(self::size)->page($page)->select();
		
		$sum = $accorder_model->where("user_id = '$user_id' AND ((time >= '$nowtime' AND state =2) OR (  is_evaluation = 0 AND state =4 ))")->count();
		$countpage = ceil($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		//未读条数
		$i = '0';
		foreach( $result as $k=>$v ){
			if( $v['is_read'] == '0' ){
				$i++;
			}
			if( $v['time'] > time() ){
				$v['hospital'] = choosehospital($v['hospital']);
				$result[$k]['title'] = "离去".$v['hospital']."出诊还有".number_format(($v['time']-time())/(60*60),2)."小时";
				$result[$k]['status'] = 'move';
			}else{
				$result[$k]['title'] = "请您对本次服务人员进行评价";
				$result[$k]['status'] = 'eva';
			}
		}
		
		$item =array(
			'tip'=>$tip,
			'info'=>array('read_count'=>$i,'list'=>$result),
		);
		exit(json_encode($item));
	}
	//设置已读
	public function change_read(){
		$order_id = I("order_id")?I("order_id"):exit(res("请传入排程id",2));
		$accorder_model = D('accorder');
		$order_info = $accorder_model->Getone(array('id'=>$order_id));
		if( $order_info ){
			if( $order_info['is_read'] == '1' ){
				exit(res("此排程已读",2));
			}
			$read_result = $accorder_model->where('id ='.$order_id)->setField('is_read','1');
			if( $read_result ){
				exit(res("修改成功",1));
			}else{
				exit(res("修改失败",2));
			}
		}else{
			exit(res("此排程不存在",2));
		}
		
	}
	
	
}