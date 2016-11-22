<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {

    //用户登录接口
    //http://192.168.0.66:8090/api.php?m=api&c=index&a=userlogin&user_id=admin&pwd=admin
    public function userlogin(){
    	$user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
    	$pwd = I("pwd")?I("pwd"):exit(res("请传入密码",2));
    	$pwd = md5(md5(I("pwd")));
    	$user = M("user");
    	$condition = array();
    	$condition['name'] = $user_id;
        $condition['password'] = $pwd;
    	$result = $user->where($condition)->find();
    	if($result){
                $data['tip']='success';
                $data['username']=$user_id;
                if(!$result['encry']){
                    $encry['encry'] =md5($user_id);
                    $user->where(array('name'=>$user_id))->save($encry);
                    $data['encry'] = $encry['encry'];
                }else{
                    $data['encry']=$result['encry'];
                }
	    		exit(json_encode($data));
    	}else{
    		exit(res("登录失败",2));
    	}
    }


    //登出
    public function loginOut(){
        $data['encry']='';
        $rs= M('user')->where(array('name'=>I('user_id')))->save($data);
        exit(res("退出成功",1));
    }


    //用户信息
    public function user_info(){
        $user_id = I("user_id")?I("user_id"):exit(res("请传入用户id",2));
        $user_model = M('user');
        $condition = array();
        $condition['name'] = $user_id;
        $result = $user_model->where(array('name'=>$user_id))->field('head,truename,company,job,mobile,tel,email,address')->find();
        if( !$result ){
            exit(res("无此用户",2));
        }
        $result['head'] = $result['head']?"http://".$_SERVER['HTTP_HOST'].$result['head']:"";
        $item =array(
            'tip'=>'success',
            'info'=>$result,
        );
        exit(json_encode($item));
    }

    //用户信息修改
    public function change_info(){
        $user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
        //先验证这个用户名是否存在
        $user = M("user");
        $condition = array();
        $condition['name'] = $user_id;
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if($info){
            $imgstr = "";
            foreach( $info as $k=>$v){
                $imgstr .= "/Uploads/".$v['savepath'] . $v['savename'];
            }
            $data['head'] = $imgstr;
        }

        $data['truename'] = I('truename');
        $data['company'] = I('company');
        $data['job'] = I('job');
        $data['mobile'] = I('mobile');
        $data['tel'] = I('tel');
        $data['email'] = I('email');
        $data['address'] = I('address');
        $result = $user->where($condition)->save($data);
        exit(res("修改成功",1));

    }



    //用户信息修改
    public function sugg(){
        $user_id = I("user_id")?I("user_id"):exit(res("请传入用户名",2));
        $info = I("info")?I("info"):exit(res("请输入建议内容",2));
        $data['info'] = I('info');
        $data['name'] = $user_id;
        $data['edit_date'] = time();
        $result = M('sugg')->add($data);
        if( $result ){
            exit(res("建议成功",1));
        }else{
            exit(res("建议失败",2));
        }
    }










}