<?php
namespace Api\Controller;
use Think\Controller;
class ServerplanController extends Controller {
	
	const size = "10";
	
	//服务端查看排程
	public function serverschedule(){
		$tip = "";
		$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护名",2));
		$page = I('page')?I('page'):1;
		$starttime = I('time')?strtotime(I('time')):strtotime(date("Y-m-d",time()));
		$nowtime = $starttime + (60*60*24);
		
		$accorder_model = D('accorder');
		$condition = array();
		$condition['acc_id'] = $acc_id;
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
		$result = $accorder_model->Getlist($condition,"id,user_id,acc_id,acc_start_time,acc_end_time,hospital,create_time,place,type,time",self::size,$page);
		$user_model = M('user');
		foreach( $result as $kk=>$vv ){
			$relist[$kk]['type'] = choosetype($relist[$kk]['type']);
			$result[$kk]['acc_start_time'] = date('H:i',$vv['acc_start_time']);
			$result[$kk]['acc_end_time'] = date('H:i',$vv['acc_end_time']);
			//获取用户头像
			$user_info = $user_model->where(array('name'=>$vv['user_id']))->field('head')->find();
			$result[$kk]['user_head'] = $user_info['head']?"http://".$_SERVER['HTTP_HOST'].$user_info['head']:"";
			//医院信息
			foreach($hospital_list as $hk => $hv){
				if( $hv['id'] == $result[$kk]['hospital']){
					$result[$kk]['hospital'] = $hv['name'];break;
				}
			}
		}
		//获取排程有那些具体日期
		$result_arr = $accorder_model->Getlist(array('state'=>array('between','2,3.9'),'acc_id'=>$acc_id,),"id,user_id,acc_start_time,acc_end_time,create_time,hospital,time,place");
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
	}
	
	//进方案定制页面
	public function planinfo(){
		//医院信息
		$hospital_list = M('hosp_class')->where(array('status'=>'1'))->select();
		//看诊类型
		$diagnose_type_list = M('diagnose_type')->select();
		$item =array(
			'tip'=>"sucess",
			'info'=>array(
				'hospital' => $hospital_list,
				'diagnose_type' => $diagnose_type_list
			),
		);
		exit(json_encode($item));
	}
	
	
	//制定方案接口
    public function plandown(){
    	$order_id = I("order_id")?I("order_id"):exit(res("请传入订单id",2));
    	$bespoke = I("bespoke")?I("bespoke"):"";
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$order_id));
    	//可重新预约
    	if( !$bespoke ){
    		if( $plan_info['state'] == '2' ){
    		exit(res("排程已制定",2));
    	}
    	}
    	if( empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$hospital = I("hospital")?I("hospital"):exit(res("请传入医院id",2));
    	$type = I("type")?I("type"):exit(res("请传入类型id",2));
    	$expert = I("expert")?I("expert"):exit(res("请传入专家名",2));
    	$place = I("place")?I("place"):exit(res("请传入会面地址",2));
    	$timed = I("timed")?I("timed"):exit(res("请传入会面时间",2));
    	
    	$time_dur = I("time_dur")?I("time_dur"):exit(res("请传入会面时段",2));
    	$time_arr = explode(",",$time_dur);
		$acc_start_time = strtotime($time_arr[0]);
		$acc_end_time = strtotime($time_arr[1]);
		$memo = I("memo");
    	$data = array(
    		'hospital' => $hospital,
    		'acc_start_time' => $acc_start_time,
    		'acc_end_time' => $acc_end_time,
    		'expert'=> $expert,
    		'place' => $place,
    		'type' => $type,
    		'time'	=> strtotime($timed),
    		'note'	=> $memo,
    		'state'	=> '2',
    	);
    	
    	$updata_reslut = $plan_model->Saveorder(array('id'=>$order_id),$data);
    	if( $updata_reslut !==false ){
    		exit(res("制定成功",1));
    	}else{
    		exit(res("制定失败",2));
    	}
    }
    
    //滑动开始服务页的方案定制信息
    public function serverinfo(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
		$accorder_model = D('accorder');
		$where = array();
		$where['id'] = $id;
		$where['state'] = array('between','2,3.9');
		$order_info = $accorder_model->Getone($where);
		if( $order_info ){
			$user_model = D('user');
			$data = array();
			$temp = $user_model->Getone(array('name'=>$order_info['user_id']),"truename,age,mobile,head,sex");
			$data['id'] = $id;
			$data['user_id'] = $order_info['user_id'];
			$data['user_age'] = $temp['age']?$temp['age']:"";
			$data['user_truename'] = $temp['truename']?$temp['truename']:"";
			$data['user_head'] = $temp['head']?"http://".$_SERVER['HTTP_HOST'].$temp['head']:"";
			$data['user_mobile'] = $temp['mobile']?$temp['mobile']:"";
			$data['hospital'] = choosehospital($order_info['hospital']);
			$data['type'] = choosetype($order_info['type']);
			$data['expert'] = $order_info['expert']?$order_info['expert']:"无";
			$data['place'] = $order_info['place'];
			$data['time'] = $order_info['time']?date('Y-m-d',$order_info['time']):"";
			$data['time_dur'] = $order_info['acc_start_time']?date("H:i",$order_info['acc_start_time'])."~".date("H:i",$order_info['acc_end_time']):"";
			$data['note'] = $order_info['note'];
			$item =array(
				'tip'=>"sucess",
				'info'=>$data,
			);
			exit(json_encode($item));
		}else{
			exit(res("此服务不存在",2));
		}
    }
    
    //滑动按钮触发后
    public function slide_begin(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$id));
    	if(  empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$user_model = D('user');
    	$user_data = array();
		$temp = $user_model->Getone(array('name'=>$plan_info['user_id']),"truename,age,mobile,head,sex,ill");
		if( $temp['sex'] == 1 ){
			$temp['sex'] = '男';
		}elseif( $temp['sex'] == 2 ){
			$temp['sex'] = '女';
		}
		//陪护人员变为繁忙
		$acc_result = M("accompany")-> where('acc_id="'.$plan_info[acc_id].'"')->setField('state','3');
		//病史
		$ill_result = M('previous')->where(array('id'=>array('in',rtrim($temp['ill'],","))))->select();
		$user_ill = "";
		foreach( $ill_result as $k=>$v ){
			$user_ill .= $v['name'].",";
		}
		$user_ill = rtrim($user_ill,",");
		
		$hospital = choosehospital($plan_info['hospital']);
		//病例扩展
		$opera_result = M('accoperation')->field('info_visit,info_diagnosis,illness,memo,price,t_imgs')->where(array('order_id'=>$id,'state'=>'1'))->find();
		$result_info = array(
			'user_head' => $temp['head']?"http://".$_SERVER['HTTP_HOST'].$temp['head']:"",
			'user_name' => $temp['truename'],
			'user_sex' => $temp['sex'],
			'user_age' => $temp['age']?$temp['age']:"",
			'user_mobile' => $temp['mobile'],
			'user_ill' => $user_ill,
			'hospital' => $hospital,
			'type'	=>	$plan_info['type'],
			'time' => date("Y-m-d",$plan_info['time']),
			'ill_info' => $opera_result['info_diagnosis']?$opera_result['info_diagnosis']:"",
			'base_info' => $opera_result['base_info']?$opera_result['base_info']:"",
		);
		$item =array(
			'tip'=>"success",
			'info'=>$result_info,
		);
		
		//修改状态（已设置已开始）
		$change_result = $plan_model->where("id=".$id)->setField('state','3');
		if( $change_result ){
			exit(json_encode($item));
		}else{
			exit(res("开始失败",2));
		}
    }
    //随机点击进入的陪诊服务页面
    public function random_acc(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$id));
    	if(  empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$user_model = D('user');
    	$user_data = array();
		$temp = $user_model->Getone(array('name'=>$plan_info['user_id']),"truename,age,mobile,head,sex,ill");
		if( $temp['sex'] == 1 ){
			$temp['sex'] = '男';
		}elseif( $temp['sex'] == 2 ){
			$temp['sex'] = '女';
		}
		//病史
		$ill_result = M('previous')->where(array('id'=>array('in',rtrim($temp['ill'],","))))->select();
		$user_ill = "";
		foreach( $ill_result as $k=>$v ){
			$user_ill .= $v['name'].",";
		}
		$user_ill = rtrim($user_ill,",");
		
		$hospital = choosehospital($plan_info['hospital']);
		
		//病例扩展
		$opera_result = M('accoperation')->where(array('order_id'=>$id,'state'=>'1'))->find();
		$result_info = array(
			'user_head' => $temp['head']?"http://".$_SERVER['HTTP_HOST'].$temp['head']:"",
			'user_name' => $temp['truename'],
			'user_sex' => $temp['sex'],
			'user_age' => $temp['age']?$temp['age']:"",
			'user_mobile' => $temp['mobile'],
			'user_ill' => $user_ill,
			'hospital' => $hospital,
			'type'	=>	$plan_info['type'],
			'time' => date("Y-m-d",$plan_info['time']),
			'ill_info' => $opera_result['info_diagnosis']?$opera_result['info_diagnosis']:"",
			'base_info' => $opera_result['base_info']?$opera_result['base_info']:"",
			'memo' => $opera_result['memo']?$opera_result['memo']:"",
		);
		$item =array(
			'tip'=>"success",
			'info'=>$result_info,
		);
		exit(json_encode($item));
    }
    //扩展信息接口
    public function oper_extend(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$id));
    	if(  empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$opera_result = array();
    	$opera_result = M('accoperation')->where(array('order_id'=>$id,'state'=>'1'))->find();
    	$t_arr = $opera_result['t_imgs']?explode(",",rtrim($opera_result['t_imgs'],",")):array();
    	if( !empty($t_arr) ){
    		foreach( $t_arr as $tk=>$tv){
	    		$t_arr[$tk] = "http://".$_SERVER['HTTP_HOST'].$tv;
	    	}
    	}
    	
    	$p_arr = $opera_result['p_imgs']?explode(",",rtrim($opera_result['p_imgs'],",")):array();
    	if( !empty($p_arr) ){
    		foreach( $p_arr as $pk=>$pv){
	    		$p_arr[$pk] = "http://".$_SERVER['HTTP_HOST'].$pv;
	    	}
    	}
    	
    	$result_info = array(
    		'memo' => $opera_result['memo']?$opera_result['memo']:"",
			'price' => $opera_result['price']?$opera_result['price']:"",
			't_imgs' => $t_arr,
			'p_imgs' => $p_arr,
		);
		$item =array(
			'tip'=>"success",
			'info'=>$result_info,
		);
		exit(json_encode($item));
    }
    
    //文字页面数据接口
    public function txt_info(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$id));
    	if(  empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$opera_result = array();
    	$opera_result = M('accoperation')->field('memo,t_imgs')->where(array('order_id'=>$id,'state'=>'1'))->find();
    	$t_arr = $opera_result['t_imgs']?explode(",",rtrim($opera_result['t_imgs'],",")):array();
    	if( !empty($t_arr) ){
    		foreach( $t_arr as $tk=>$tv){
	    		$t_arr[$tk] = "http://".$_SERVER['HTTP_HOST'].$tv;
	    	}
    	}
    	$result_info = array(
    		'memo' => $opera_result['memo']?$opera_result['memo']:"",
			't_imgs' => $t_arr,
		);
		$item =array(
			'tip'=>"success",
			'info'=>$result_info,
		);
		exit(json_encode($item));
    }
    
    
    //文字提交
    public function submit_txt(){
    	$order_id = I("order_id")?I("order_id"):exit(res("请传入排程id",2));
    	//整理图片
    	$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =     ''; // 设置附件上传（子）目录
		// 上传文件
		$info=$upload->upload();
		if( $info ){
			$imgstr = "";
			foreach( $info as $k=>$v){
				$imgstr .= "/Uploads/".$v['savepath'] . $v['savename'].",";
			}
		}else{
			$imgstr = "";
		}
		$result_data = array();
		$result_data['memo'] = I("memo")?I("memo"):"";
		$result_data['t_imgs'] = $imgstr;
    	$accoperation_model = D('accoperation');
    	$accoperation_result = $accoperation_model->Getone(array('order_id'=>$order_id,'state'=>'1'));
    	if( !empty($accoperation_result) ){
    		$update_result = $accoperation_model->Saveuser($result_data,array('order_id'=>$order_id,'state'=>'1'));
    		if( $update_result != false){
    			exit(res("提交成功",1));
    		}else{
    			exit(res("提交失败",2));
    		}
    	}else{
    		$result_data['order_id'] = $order_id;
    		$update_result = $accoperation_model->Adduser($result_data);
    		if( $update_result != false){
    			exit(res("提交成功",1));
    		}else{
    			exit(res("提交失败",2));
    		}
    	}
    }
    
    
    //费用页面
    public function price_info(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$id));
    	if(  empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$opera_result = array();
    	$opera_result = M('accoperation')->field('price,p_imgs')->where(array('order_id'=>$id,'state'=>'1'))->find();
    	$price_arr = array();
    	$img_arr = array();
    	$price_arr = unserialize($opera_result['price']);
    	$img_arr = unserialize($opera_result['p_imgs']);
    	$all_price = allprice_type();

		$price_info = array();
		foreach( $all_price as $k=>$v ){
			$price_info[$v['id']] = $v['name'];
		}

		$final_arr = array();
		$i = 0;
		foreach( $price_arr as $k=>$v ){
			if( in_array($k,array_keys($price_info))){
				$final_arr[$i][id] = $k;
				$final_arr[$i][type_name] = $price_info[$k];
				$final_arr[$i][price] = $v;
				$temimg_arr = array();
				$temimg_arr = explode(",",rtrim($img_arr[$k],","));
				foreach( $temimg_arr as $kk=>$vv){
					$temimg_arr[$kk] = "http://".$_SERVER['HTTP_HOST'].$v;
				}
				$final_arr[$i][img] = $temimg_arr;
			}
			$i++;
		}
    	$item =array(
			'tip'=>"success",
			'info'=>$final_arr,
		);
		exit(json_encode($item));
    }
    
    //费用提交
    public function price_submit(){
    	$id = I("id")?I("id"):exit(res("请传入服务id",2));
    	$type = I("type")?I("type"):exit(res("请传入费用类型",2));
    	$money = I("money")?I("money"):exit(res("请传入费用价格",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$id));
    	if(  empty($plan_info) ){
    		exit(res("排程不存在",2));
    	}
    	$opera_result = array();
    	$opera_result = M('accoperation')->where(array('order_id'=>$id,'state'=>'1'))->find();
    	$price_arr = array();
    	$img_arr = array();
    	$price_arr = unserialize($opera_result['price']);
    	$img_arr = unserialize($opera_result['p_imgs']);
    	//图片的提交
    	$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =     ''; // 设置附件上传（子）目录
		// 上传文件
		$info=$upload->upload();
		if( $info ){
			$imgstr = "";
			foreach( $info as $k=>$v){
				$imgstr .= "/Uploads/".$v['savepath'] . $v['savename'].",";
			}
		}else{
			$imgstr = "";
		}
    	//$price_key = array_keys($price_arr);
		//判断原表中是否有此类型的数据
    	if( in_array($type,array_keys($price_arr)) ){
    		$price_arr[$type] = $money;
    	}else{
    		$temp_money = array(
				$type => $money,
			);
			$price_arr = $img_arr + $temp_money;
    	}
    	
    	if( in_array($type,array_keys($img_arr)) ){
			$img_arr[$type] = $imgstr;
		}else{
			$temp_img = array(
				$type => $imgstr,
			);
			$img_arr = $img_arr + $temp_img;
		}
		
		$price_data = array(
			'price'		=> serialize($price_arr),
			'p_imgs'	=> serialize($img_arr)
		);
		
		$change_result = "";
		if( !empty($opera_result) ){
			$change_result = M('accoperation')->where(array('order_id'=>$id,'state'=>'1'))->save($price_data);
		}else{
			$change_result = M('accoperation')->add($price_data);
		}
		if( $change_result !== false ){
			exit(res("提交成功",1));
		}else{
			exit(res("提交失败",2));
		}
    }
    
    
    //完成订单
    public function end_schdule(){
    	$order_id = I("order_id")?I("order_id"):exit(res("请传入排程id",2));
    	$plan_model = D('accorder');
    	$plan_info = $plan_model->Getone(array('id'=>$order_id));
    	if( $plan_info['state'] == '4' ){
    		exit(res("您的订单已结束，不可重复结束",2));
    	}
    	//更改订单状态
    	$update_arr = array(
    		'state' => '4',
    	);
    	$plan_update = $plan_model->Saveorder(array('id'=>$order_id),$update_arr);
    	if( $plan_update ){
    		//推送客户评价
	    	$user_info = array();
	    	$user_model = D('user');
	    	$user_info = $user_model->Getone(array('name'=>$plan_info['user_id']));
	    	$machine_id = $user_info['machine_id'];
	    	$machine_type = $user_info['machine_type'];
	    	$description = "您有新排程结束，请评价";
	    	$push_data = array(
	    		'user_id'	=> $plan_info['user_id'],
	    		'order_id'	=> $order_id,
	    		'status'	=> 'eva',
	    	);
	    	$result = push_send($machine_id,$description,$machine_type,$push_data);
	    	if( $result ){
	    		exit(res("结束成功",1));
	    	}else{
	    		exit(res("结束失败",2));
	    	}
    	}else{
    		exit(res("修改状态失败",2));
    	}
    	
    }
    
    
    
}