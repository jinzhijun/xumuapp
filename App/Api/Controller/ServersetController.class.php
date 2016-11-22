<?php
namespace Api\Controller;
use Think\Controller;
class ServersetController extends Controller {
    //修改陪护资料
    public function acc_update(){
		$acc_id = I("acc_id")?I("acc_id"):exit(res("请传入陪护标识",2));
		$sex = I("sex")?I("sex"):exit(res("请传入性别",2));
		$birthday = I("birthday")?I("birthday"):exit(res("请传入生日",2));
		$data = array();
		$where = array();
		$where['acc_id'] = $acc_id;
		$data['sex'] = I("sex");
		$data['birthday'] = strtotime(I("birthday"));
		
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
		$data['head'] = rtrim($imgstr,",");
		
		$accompany_model = D('accompany');
		$result = $accompany_model->Saveuser($where,$data);
		if( $result !== false ){
			exit(res("修改成功",1));
		}else{
			exit(res("修改失败",2));
		}
    }
    
    //联系客服
    public function custom(){
    	$phone_result = M("setting")->where(array('name'=>'custom_phone'))->find();
    	$phone_arr = explode(",",$phone_result['value']);
    	$item_r = array();
    	foreach( $phone_arr as $k=>$v ){
    		$item_r[phone.($k+1)] = $v;
    	}
    	$item =array(
				'tip'=>"sucess",
				'info'=>$item_r,
			);
		exit(json_encode($item));
    }
    
    
}