<?php
namespace Api\Controller;
use Think\Controller;
class RequestController extends Controller {
	
	const size = "10";
	
	//建立请求
	public function creat_request(){
		$user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
		$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
		$user_model = D('user');
		$user_condition = array();
		$user_condition['name'] = $user_id;
		$user_result = $user_model->Getone($user_condition);
		if( !$user_result ){
			exit(res("传入用户有误",2));
		}
		$acc_condition = array();
		$acc_condition['acc_id'] = $acc_id;
		$acc_model = D('Accompany');
		$acc_result = $acc_model->Getone($acc_condition);
		if( !$acc_result ){
			exit(res("传入陪护人员有误",2));
		}
		$data = array();
		$data['user_id'] = $user_id;
		$data['user_name'] = $user_name;
		$data['acc_id'] = $acc_id;
		$data['create_time'] = time();
		$data['state'] = "0";
		$request_model = D('accorder');
		$f_result = $request_model->Addorder($data);
		if( $f_result ){
			exit(res("请求成功",1));
			//接单量加1
			/*$inc_result = $acc_model->where(array('acc_id'=>$acc_id))->setInc('orders',1); //用户的订单量加1
			if( $inc_result ){
				exit(res("success",1));
			}else{
				exit(res("error",2));
			}*/
		}else{
			exit(res("请求失败",2));
		}
	}
	
	//http://192.168.0.99:8090/api.php?m=api&c=request&a=confirm&order_id=3,4,
	//确定服务
	public function confirm(){
		$order_id = I("order_id")?I("order_id"):exit(res("请传入服务请求id",2));
		$page = I('page')?I('page'):1;
		$order_id = rtrim($order_id,",");
		$order_model = D('accorder');
		$order_condition = array(
			id => array("in",$order_id),
		);
		//读取配置
		$set_result = M('setting')->where(array('name'=>'server_date'))->find();
		$time_result = $order_model->Getlist($order_condition,"id,user_id,acc_id,hospital,create_time,place,type,time");
		foreach( $time_result as $tk=>$tv){
			if( (time() - $tv['create_time']) >= ($set_result['value']*60*60)){
				$up_data = array('is_time'=>'0','state'=>'1');
				$change_result = $order_model->where('id='.$tv['id'])->setField($up_data);
				if( $chage_result === false ){
					$up_result = false;
					break;
				}
			}else{
				$up_data = array('is_time'=>'1','state'=>'1');
				$change_result = $order_model->where('id='.$tv['id'])->setField($up_data);
				if( $chage_result === false ){
					$up_result = false;
					break;
				}
			}
			$up_result = true;
		}
		if( $up_result !== false ){
			$sum = $order_model->where($order_condition)->count();
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
			$result = $order_model->Getlist($order_condition,"id,user_id,acc_id,hospital,create_time,place,type,time",self::size,$page);
			$user_model = M('user');
			foreach( $result as $kk=>$vv ){
				//获取用户头像
				$user_info = $user_model->where(array('name'=>$vv['user_id']))->field('head,sex,truename,mobile,age')->find();
				$result[$kk]['user_head'] = $user_info['head']?"http://".$_SERVER['HTTP_HOST'].$user_info['head']:"";
				if( $user_info['sex'] == '1' ){
					$user_info['sex'] == "男";
				}else{
					$user_info['sex'] == "女";
				}
				$result[$kk]['type'] = choosetype($result[$kk]['type']);
				$result[$kk]['user_truename'] = $user_info['truename']?$user_info['truename']:"";
				$result[$kk]['user_mobile'] = $user_info['mobile']?$user_info['mobile']:"";
				$result[$kk]['user_age'] = $user_info['age']?$user_info['age']:"";
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
		}else{
			exit(res("确认失败",2));
		}
	}
	
	
	//随机选取陪诊人员
	public function random_acc(){
		$acc_condition = array();
		$acc_condition['state'] = '1';
		$result = M('accompany')->where($acc_condition)->field('id,head,sex,state,addtime,acc_id,name,mobile,birthtime')->order('rand()')->find();
		if( $result ){
			$item =array(
				'tip'=>"success",
				'info'=>$result,
			);
			exit(json_encode($item));
		}else{
			exit(res("暂时无陪护",2));
		}
	}
	
	
	//对陪诊人员的评价首页
	public function evaluation_index(){
		$order_id = I("order_id")?I("order_id"):exit(res("请传入订单id",2));
		//获取订单里的acc_id 和 user_id
		$alluser_result = M('accorder')->where("id=".$order_id)->find();
		if( $alluser_result['is_evaluation'] == '1' ){
			exit(res("此订单已评价",2));
		}
		//查询对陪护的评价
		$evaluation_model = M('evaluation');
    	$eva_sum = $evaluation_model->where(array('acc_id'=>$alluser_result['acc_id']))->count();
    	$sumScore  = $evaluation_model->where(array('acc_id'=>$alluser_result['acc_id']))->sum('score');
    	$eva_score = number_format($sumScore/$eva_sum,'1');
    	//查询陪护信息
    	$accompany = D('accompany');
    	$info_acc = $accompany->Getone(array('acc_id'=>$alluser_result['acc_id']));
    	$eva_data = array();
    	$eva_data['acc_id'] = $info_acc['acc_id'];
    	$eva_data['user_id'] = $info_acc['user_id'];
    	$eva_data['head'] = $eva_data['head']?"http://".$_SERVER['HTTP_HOST'].$info_acc['head']:"";
    	$eva_data['name'] = $info_acc['name'];
    	$alluser_result['type'] = $alluser_result['type']?choosetype($alluser_result['type']):"";
    	$eva_data['type'] = $alluser_result['hospital'].$alluser_result['type'];
    	$eva_data['score'] = $eva_score;
    	//查询好评理由
    	$evaluation_model = M('setting')->where(array('name'=>'good_reputation'))->find();
    	$eva_data['good_reputation'] = $evaluation_model['value'];
    	//标记已读
		$change_result = M('accorder')->where("id=".$order_id)->setField('is_read','1');
    	$item =array(
			'tip'=>"",
			'info'=>$eva_data,
		);
		exit(json_encode($item));
	}
	
	//投诉界面
	public function evaluation_bad(){
		$bad_model = M('setting')->where(array('name'=>'negative_comment'))->find();
		$bad_info = explode(",",$bad_model['value']);
		foreach( $bad_info as $k=>$v){
			$bad_result['bad'.($k+1)] = $v;
		}
		$item =array(
			'tip'=>"",
			'info'=>$bad_result,
		);
		exit(json_encode($item));
	}
	
	
	//对陪诊人员的评价接口
	public function evaluation(){
		$order_id = I("order_id")?I("order_id"):exit(res("请传入订单id",2));
		$accorder_moder = M('accorder');
		//获取订单里的acc_id 和 user_id
		$alluser_result = $accorder_moder->where("id=".$order_id)->field("user_id,acc_id,is_evaluation")->find();
		if( $alluser_result['is_evaluation'] == '1' ){
			exit(res("此订单已评价",2));
		}
		$score = I("score");
		$content = I("content");
		
		$data = array();
		$data['score'] = $score;
		$data['order_id'] = $order_id;
		$data['user_id'] = $alluser_result['user_id'];//传还是不传有待商榷
		$data['acc_id'] = $alluser_result['acc_id'];//传还是不传有待商榷
		$data['memo'] = $content;
		$data['type'] = I('type')?I('type'):'1';
		$result = M("evaluation")->add($data);
		if( $result ){
			//修改订单表中评价字段
			$change_result = $accorder_moder->where("id=".$order_id)->setField('is_evaluation','1');
			if( $change_result ){
				exit(res("评价成功",1));
			}else{
				exit(res("评价失败",2));
			}
		}else{
			exit(res("评价失败",2));
		}
	}

	//服务请求列表
	public function serve_request(){
		$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
		$page = I('page')?I('page'):1;
		$order_model = D('accorder');
		$request_condition = array();
		$request_condition['acc_id'] = $acc_id;
		$request_condition['state'] = '0';
		$sum = $order_model->where($request_condition)->count();
		$countpage = ceil($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		$user_model = D('user');
		$relist = $order_model->Getlist($request_condition,"id,user_id,acc_id,hospital,create_time,place,type,time",self::size,$page);
		//获取医院信息
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->field('id,name,date')->select();
		foreach( $relist as $k=>$v ){
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result[$k]['hospital']){
					$result[$k]['hospital'] = $hv['name'];break;
				}
			}
			$temp = $user_model->Getone(array('name'=>$v['user_id']),"truename,age,sex,mobile,head");
			$relist[$k]['user_age'] = $temp['age']?$temp['age']:"";
			$relist[$k]['user_head'] = $temp['head']?"http://".$_SERVER['HTTP_HOST'].$temp['head']:"";
			if( $temp['sex'] == 1 ){
				$relist[$k]['sex'] = "男";
			}else{
				$relist[$k]['sex'] = "女";
			}
			$relist[$k]['user_truename'] = $temp['truename']?$temp['truename']:"";
			$relist[$k]['user_mobile'] = $temp['mobile']?$temp['mobile']:"";
			$relist[$k]['type'] = choosetype($relist[$k]['type']);
		}
		$item =array(
			'tip'=>$tip,
			'info'=>$relist,
		);
		exit(json_encode($item));
	}

	//方案定制列表
	public function planset_list(){
		$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
		$page = I('page')?I('page'):1;
		$order_model = D('accorder');
		$request_condition = array();
		$request_condition['acc_id'] = $acc_id;
		$request_condition['state'] = '1';
		$sum = $order_model->where($request_condition)->count();
		$countpage = ceil($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		$user_model = D('user');
		$relist = $order_model->Getlist($request_condition,"id,user_id,acc_id,hospital,create_time,place,type,time",self::size,$page);
		//获取医院信息
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->field('id,name,date')->select();
		foreach( $relist as $k=>$v ){
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result[$k]['hospital']){
					$result[$k]['hospital'] = $hv['name'];break;
				}
			}
			$temp = $user_model->Getone(array('name'=>$v['user_id']),"truename,age,sex,mobile,head");
			$relist[$k]['user_age'] = $temp['age']?$temp['age']:"";
			$relist[$k]['user_head'] = $temp['head']?"http://".$_SERVER['HTTP_HOST'].$temp['head']:"";
			if( $temp['sex'] == 1 ){
				$relist[$k]['sex'] = "男";
			}else{
				$relist[$k]['sex'] = "女";
			}
			$relist[$k]['user_truename'] = $temp['truename']?$temp['truename']:"";
			$relist[$k]['user_mobile'] = $temp['mobile']?$temp['mobile']:"";
		}
		$item =array(
			'tip'=>$tip,
			'info'=>$relist,
		);
		exit(json_encode($item));
	}
	
	//陪诊服务列表
	public function diagnosis_server(){
		$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护id",2));
		$page = I('page')?I('page'):1;
		$order_model = D('accorder');
		$request_condition = array();
		$request_condition['acc_id'] = $acc_id;
		$request_condition['state'] = array('between','2,3.9');
		$sum = $order_model->where($request_condition)->count();
		$countpage = ceil($sum/self::size);
		if( $countpage > $page ){
			$tip = "have";
		}else{
			$page = $countpage;
			$tip = "no";
		}
		$user_model = D('user');
		$relist = $order_model->Getlist($request_condition,"id,user_id,acc_id,acc_start_time,acc_end_time,state,hospital,create_time,place,type,time",self::size,$page);
		//获取医院信息
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->field('id,name,date')->select();
		foreach( $relist as $k=>$v ){
			$relist[$k]['time'] = $v['time']?date('Y-m-d',$v['time']):"";
			$relist[$k]['acc_start_time'] = $v['acc_start_time']?$v['acc_start_time']:"";
			$relist[$k]['acc_end_time'] = $v['acc_end_time']?$v['acc_end_time']:"";
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result[$k]['hospital']){
					$result[$k]['hospital'] = $hv['name'];break;
				}
			}
			$temp = $user_model->Getone(array('name'=>$v['user_id']),"truename,age,sex,mobile,head");
			$relist[$k]['user_age'] = $temp['age']?$temp['age']:"";
			$relist[$k]['user_head'] = $temp['head']?"http://".$_SERVER['HTTP_HOST'].$temp['head']:"";
			if( $temp['sex'] == 1 ){
				$relist[$k]['sex'] = "男";
			}else{
				$relist[$k]['sex'] = "女";
			}
			$relist[$k]['user_truename'] = $temp['truename']?$temp['truename']:"";
			$relist[$k]['user_mobile'] = $temp['mobile']?$temp['mobile']:"";
			$relist[$k]['type'] = choosetype($relist[$k]['type']);
		}
		$item =array(
			'tip'=>$tip,
			'info'=>$relist,
		);
		exit(json_encode($item));
	}
	


}