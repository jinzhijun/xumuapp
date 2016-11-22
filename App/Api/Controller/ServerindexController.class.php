<?php
namespace Api\Controller;
use Think\Controller;
class ServerindexController extends Controller {
	
	const size = "10";
	
	//服务端登录后首页接口
	//http://192.168.0.99:8090/api.php?m=api&c=serverindex&a=index&acc_id=ceshi&page=1
    public function index(){
    	$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
    	//订单响应率
    	$t_condition = array();
    	$t_condition['is_time'] = 1;
    	$t_condition['acc_id'] = $acc_id;
    	$t_condition['state'] = array("gt","0");
    	$t_sum = M('accorder')->where($t_condition)->count();//查询及时响应的订单

    	$order_condition = array(
    		'acc_id' => $acc_id,
    		'state' => array("gt","0"),
    	);
    	$sum = M('accorder')->where($order_condition)->count();//查询总订单数
    	$responsivity =	number_format($t_sum/$sum,"2");//是否要换算成百分号形式
    	//在线时长
    	$online = "0";
    	$online_result = M('work_log')->where(array('acc_id'=>$acc_id))->field("login_time,out_time")->select();
    	foreach( $online_result as $key=>$value){
    		if( $value['out_time'] == "" ){
    			$today_str = date("Y-m-d",$value['login_time']);
    			$online += (strtotime($today_str.C('OUT_TIME')) - $value['login_time']);
    		}else{
    			if( ($value['out_time'] - $value['login_time']) > (C('ONWORK_TIME')*60*60) ){
    				$online += (C('ONWORK_TIME')*60*60);
    			}else{
    				$online += ($value['out_time'] - $value['login_time']);
    			}
    		}
    	}
    	$online =number_format(($online/(60*60)),'2',".","");
    	//接单数量
    	$allorder_condition = array(
    		'acc_id' => $acc_id,
    		'state' => array("egt","0"),
    	);
    	$allsum = M('accorder')->where($allorder_condition)->count();//查询总接单数
    	//陪诊量（产生的订单就是陪诊量，就是上面的$sum）
    	//评价记录
    	$eva_model = D("evaluation");
    	$eva_condition = array();
    	$eva_condition['acc_id'] = $acc_id;
    	$page = I('page')?I('page'):1;
    	$all_sum = $eva_model->where($eva_condition)->count();
    	$countpage = ($all_sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		//评价的列表
		$eva_result = $eva_model->Getlist($eva_condition,"",self::size,$page);
		
		$item_ev = array();
		$item_ev['responsivity'] = $responsivity;
		$item_ev['online'] = $online;
		$item_ev['orders'] = $allsum;
		$item_ev['sum'] = $sum;//陪诊量
		$item_ev['list'] = $eva_result;
		$item =array(
			'tip'=>$tip,
			'info'=>$item_ev,
		);
		exit(json_encode($item));
    }
    
    //我的页面接口
    public function myindex(){
    	$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
    	$page = I('page')?I('page'):1;
    	
    	//查询陪护相关信息
    	$accompany_model = D('accompany');
    	$accinfo_result = $accompany_model->Getone(array('acc_id'=>$acc_id),'head,sex,name,mobile');
    	//订单响应率
    	$t_condition = array();
    	$t_condition['is_time'] = 1;
    	$t_condition['acc_id'] = $acc_id;
    	$t_condition['state'] = array("gt","0");
    	$t_sum = M('accorder')->where($t_condition)->count();//查询及时响应的订单

    	$order_condition = array(
    		'acc_id' => $acc_id,
    		'state' => array("gt","0"),
    	);
    	$sum = M('accorder')->where($order_condition)->count();//查询总订单数
    	$responsivity =	number_format($t_sum/$sum,"2");//是否要换算成百分号形式
    	//查询评价
    	$evaluation_model = M('evaluation');
    	$eva_sum = $evaluation_model->where(array('acc_id'=>$acc_id))->count();
    	$sumScore  = $evaluation_model->where(array('acc_id'=>$acc_id))->sum('score');
    	$eva_score = number_format($sumScore/$eva_sum,'1');
    	$bad_sum = $evaluation_model->where(array('acc_id'=>$acc_id,'type'=>'2'))->count();
    	//在线时长
    	$online = "";
    	$online_result = M('work_log')->where(array('acc_id'=>$acc_id))->field("login_time,out_time")->select();
    	foreach( $online_result as $key=>$value){
    		if( $value['out_time'] == "" ){
    			$today_str = date("Y-m-d",$value['login_time']);
    			$online += (strtotime($today_str.C('OUT_TIME')) - $value['login_time']);
    		}else{
    			if( ($value['out_time'] - $value['login_time']) > (C('ONWORK_TIME')*60*60) ){
    				$online += (C('ONWORK_TIME')*60*60);
    			}else{
    				$online += ($value['out_time'] - $value['login_time']);
    			}
    		}
    	}
    	$online =number_format(($online/(60*60)),'2',".","");
    	//接单数量
    	$allorder_condition = array(
    		'acc_id' => $acc_id,
    		'state' => array("egt","0"),
    	);
    	$allsum = M('accorder')->where($allorder_condition)->count();//查询总接单数
    	//陪诊量（产生的订单就是陪诊量，就是上面的$sum）
		//订单列表
		$accorder_model = D('accorder');
		$condition = array();
		$condition['acc_id'] = $acc_id;
		$condition['state'] = array('egt','1');
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
		$result_acc = $accorder_model->Getlist($condition,"id,user_id,acc_id,acc_start_time,acc_end_time,hospital,create_time,place,time",self::size,$page);
		$acc_model = M('user');
		foreach( $result_acc as $kk=>$vv ){
			$result_acc[$kk]['acc_start_time'] = date('H:i',$vv['acc_start_time']);
			$result_acc[$kk]['acc_end_time'] = date('H:i',$vv['acc_end_time']);
			//获取用户人员头像
			$acc_info = $acc_model->where(array('name'=>$vv['user_id']))->field('head')->find();
			$result_acc[$kk]['user_head'] = "http://".$_SERVER['HTTP_HOST'].$acc_info['head'];
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result_acc[$kk]['hospital']){
					$result_acc[$kk]['hospital'] = $hv['name'];break;
				}
			}
		}
		
		$item_ev = array();
		
		$item_ev['acc_head'] = "http://".$_SERVER['HTTP_HOST'].$accinfo_result['head'];
		if($accinfo_result['sex'] == '1'){
			$item_ev['sex'] = "男";
		}else{
			$item_ev['sex'] = '女';
		}
		$item_ev['mobile'] = $accinfo_result['mobile'];
		$item_ev['name'] = $accinfo_result['name'];
		$item_ev['responsivity'] = $responsivity;
		$item_ev['online'] = $online;
		$item_ev['orders'] = $allsum;
		$item_ev['sum'] = $sum;//陪诊量
		$item_ev['eva_score'] = $eva_score;
		$item_ev['bad_sum'] = $bad_sum;
		$item_ev['list'] = $result_acc;
		$item =array(
			'tip'=>$tip,
			'info'=>$item_ev,
		);
		exit(json_encode($item));
    }
    
    
    //点击头像进入后页面
    public function accinfo(){
    	$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
    	$accompany_model = D('accompany');
    	$accinfo_result = $accompany_model->Getone(array('acc_id'=>$acc_id),'head,sex,name,mobile');
    	if( $accinfo_result ){
    		$item_ev = array();
    		$item_ev['head'] = "http://".$_SERVER['HTTP_HOST'].$accinfo_result['head'];
    		if($accinfo_result['sex'] == '1'){
				$item_ev['sex'] = "男";
			}else{
				$item_ev['sex'] = '女';
			}
    		$item_ev['name'] = $accinfo_result['name'];
    		$item_ev['mobile'] = $accinfo_result['mobile'];
    		$item =array(
				'tip'=>"success",
				'info'=>$item_ev,
			);
			exit(json_encode($item));
    	}else{
    		exit(res("不存在此人",2));
    	}
    	
    	
    }
    
}