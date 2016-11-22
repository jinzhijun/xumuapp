<?php
namespace Api\Controller;
use Think\Controller;
class ServerloginController extends Controller {
    //陪护登录接口
    //http://www.hospital.com/api.php?m=api&c=serverlogin&a=serverlogin&servername=admin&pwd=admin
    public function serverlogin(){
    	$servername = I("servername")?I("servername"):exit(res("请传入用户名",2));
    	$pwd = I("pwd")?I("pwd"):exit(res("请传入密码",2));
    	$pwd = md5(md5(I("pwd")));
    	$accompany = M("accompany");
    	$condition = array();
    	$condition['acc_id'] = $servername;
    	$result = $accompany->where($condition)->find();
    	if( $result ){
    		if( $result['pwd'] == $pwd ){
    			$item_result = array(
    				'head' => "http://".$_SERVER['HTTP_HOST'].$result['head'],
    				'state'=> $result['state'],
    			);
    			$item =array(
					'tip'=>"success",
					'info'=>$item_result,
				);
				exit(json_encode($item));
	    		//exit(res("登录成功",1));
	    	}else{
	    		exit(res("登录失败",2));
	    	}
    	}else{
    		exit(res("登录失败",2));
    	}
    }
    
    //陪护修改密码接口
    public function changepwd(){
    	$servername = I("servername")?I("servername"):exit(res("请传入用户名",2));
    	$pwd = I("pwd")?I("pwd"):exit(res("请传入密码",2));
    	//先验证这个用户名是否存在
    	$accompany = M("accompany");
    	$condition = array();
    	$condition['acc_id'] = $servername;
    	$result = $accompany->where($condition)->find();
    	if( $result ){
    		$pwd = md5(md5(I("pwd")));
    		$res = $accompany->where("id=25")->setField('pwd',$pwd);
    		if( $res !== false ){
    			exit(res("更改成功",1));
    		}else{
    			exit(res("更改失败",2));
    		}
    	}else{
    		exit(res("无此用户",2));
    	}
    }
    
    //上班后首页
    public function onindex(){
    	$servername = I("acc_id")?I("acc_id"):exit(res("请传入用户名",2));
    	//查询陪护相关信息
    	$accompany_model = D('accompany');
    	$acc_result = $accompany_model->Getone(array('acc_id'=>$servername),'head,sex,name');
    	if( !$acc_result ){
    		exit(res("不存在此人",2));
    	}
    	//查询完成单量
    	$order_model = D('accorder');
    	$over_orders = $order_model->where(array('acc_id'=>$servername,'state'=>4))->count();
    	//查询评价
    	$evaluation_model = M('evaluation');
    	$eva_sum = $evaluation_model->where(array('acc_id'=>$servername))->count();
    	$sumScore  = $evaluation_model->where(array('acc_id'=>$alluser_result['acc_id']))->sum('score');
    	$eva_score = number_format($sumScore/$eva_sum,'1');
		//待处理服务请求
    	$wait_sum = $order_model->where(array('acc_id'=>$servername,'state'=>'0'))->count();
    	//待制定方案
    	$make_sum = $order_model->where(array('acc_id'=>$servername,'state'=>'1'))->count();
    	//待陪诊客户
    	$go_sum = $order_model->where(array('acc_id'=>$servername,'state'=>array('between','2,3.9')))->count();
    	//今日时间安排
    	$starttime = strtotime(date("Y-m-d",time()));
		$nowtime = $starttime + (60*60*24);
    	$order_condition = array();
		$order_condition['acc_id'] = $servername;
		$order_condition['state'] = array('between','2,3.9');
		$order_condition['time'] = array('between',array($starttime,$nowtime));
		$result_order = $order_model->Getlist($order_condition,"id,user_id,acc_id,acc_start_time,acc_end_time,time,hospital,place");

		//上班时间记录
		$work_model = M("work_log");
		$work_data = array(
			'acc_id' => $servername,
			'login_time' => time()
		);
		$work_result = $work_model->add($work_data);
		
		//修改陪护人员状态
		$acc_model = M('accompany');
		$acc_model-> where("acc_id="."'".$servername."'")->setField('state','1');
		
		$item_result = array(
			'acc_login_id' => $work_result,
			'member_info' => $acc_result,
			'over_orders' => $over_orders,
			'evaluation' => $eva_score,
			'wait_sum' => $wait_sum,
			'make_sum' => $make_sum,
			'go_sum' => $go_sum,
			'today_plan' => $result_order
		);
		
		$item =array(
			'tip'=>"success",
			'info'=>$item_result,
		);
		exit(json_encode($item));
    }
    
    //下班接口
    //http://192.168.0.66:8090/api.php?m=api&c=serverlogin&a=outwork&servername=ceshi&login_id=1
    public function outwork(){
    	$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入用户名",2));
    	$login_id = I("login_id")?I("login_id"):exit(res("请传入登录时id",2));
    	$work_model = M("work_log");
    	$workinfo_result = $work_model->where(array('id'=>$login_id))->find();
    	if( !empty($workinfo_result['out_time'])){
    		exit(res("已下班",2));
    	}
    	$work_result = $work_model->where(array('id'=>$login_id))->setField('out_time',time());
    	if( $work_result ){
    		//计算此次在线时间长度
    		$work_info = $work_model->where(array('id'=>$login_id))->find();
    		$deltime = $work_info['out_time'] - $work_info['login_time'];
    		if( $deltime > (8*60*60)){
    			$deltime = (8*60*60);
    		}
    		//修改陪护人员状态
    		$acc_model = M('accompany');
    		$acc_model-> where("acc_id="."'".$acc_id."'")->setField('state','0');
    		//修改陪护人员在线时间
    		$acc_model-> where("acc_id="."'".$acc_id."'")->setInc('online',$deltime);
    		exit(res("下班成功",1));
    	}else{
    		exit(res("下班失败",2));
    	}
    }
    
}