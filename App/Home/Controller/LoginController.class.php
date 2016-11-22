<?php
namespace Home\Controller;
use Think\Controller;
use Org\Util\ApiEasemobAction;
class LoginController extends BaseController {
    function _initialize(){
        $this->name = cookie("username");
    }
    public function login(){
      $this->display();
    }
    //登出
    public function loginOut(){
        $this->success('退出成功！');
        $this->display();
    }
    //注册
    public function register(){
        if(IS_POST){
            $name= M('user')->where(array('name'=>$_POST['name']))->find();
            if($name){
                $data['status']= 0;
                $data['info']= "账号已经存在";
            }else{
                if(md5(md5($_POST['password']))==md5(md5($_POST['rpassword']))){

                    $data['name'] = $_POST['name'];
                    $data['truename'] = $_POST['truename'];
                    $data['tel'] = $_POST['tel'];
                    $data['card'] = $_POST['card'];
                    $data['payname'] = $_POST['payname'];
                    $data['pay'] = $_POST['pay'];
                    $data['province'] = $_POST['province'];
                    $data['city'] = $_POST['city'];
                    $data['area'] = $_POST['area'];
                    $data['address'] = $_POST['address'];
                    $data['pass_initialize'] = 1;
                    $data['password'] = md5(md5($_POST['password']));
                    $data['date'] = time();
                    $data['status'] = 0;
                    $data['grade_id'] = 1;
                    //对人员进行分组
                    $group_temp = $data['province'].$data['city'].$data['area'];
                    $first_str = pinyin1($group_temp);
                    $data['group_mark'] = $first_str;
                    //查询群组是否存在
                    $condition = array(
                    		'market_id' => $first_str,
                    	);
                    $group_result = M('group_hx')->where($condition)->find();
                	try{
		            	$this->group = D('group_hx');
		            	$this->user = D('user');
		            	$this->group->startTrans();
		            	//实例化类
		            	$ApiEasemobAction = new ApiEasemobAction();
		            	//给注册人添加环信账号
		            	$register_result = $ApiEasemobAction->accreditRegister($data['name'],"123456");
		            	$register_result = json_decode($register_result);

		            	if( isset( $register_result['error'] ) ){
		            		throw new \Exception('环信身份注册失败');
		            	}
		            	if( !$group_result ){
		            		//创建群组
			            	$option = array(
	                			'groupname'=> $first_str,
	                			'desc' => $group_temp."的群组",
	                			'public' => true,
	                			'approval' => false,
	                			'owner' => $data['name'],
	                		);
	                    	$creat_result = $ApiEasemobAction->createGroups($option);
	                    	$creat_result = json_decode($creat_result,true);
	                    	if( isset( $creat_result['error'] ) ){
	                    		throw new \Exception('创建群组失败');
	                    	}
	                    	//创建群组end
	                    	//保存群组到数据库
	                    	$group_data = array(
	                				'market_id' => $first_str,
	                				'market_name' => $group_temp,
	                				'create_user' => $data['name'],
	                				'create_time' => time(),
	                				'group_id' => $creat_result['data']['groupid'],
	                			);
	                		$groupadd_result = $this->group->add($group_data);
	                		if( !$groupadd_result ){
	                			throw new \Exception('群组数据库保存失败');
	                		}
		            	}else{

		            		$user_addresult = $ApiEasemobAction->addGroupsUser($group_result['group_id'],$data['name']);
		            		$user_addresult = json_decode($user_addresult,true);
	                    	if( isset( $user_addresult['error'] ) ){
	                    		throw new \Exception('群组添加成员失败');
	                    	}
		            	}
                		//保存用户信息
                		$rs = $this->user->add($data);
                		if( !$rs ){
	                        throw new \Exception('用户保存失败');
	                    }
						$this->group->commit();
		            }catch(\Exception $e){

		            	$this->group->rollback();
//		            	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
//			        	echo "<script>alert('".$e->getMessage()."');window.location.href=\"".U('register')."\";</script>";exit;
                        $data['status']= 0;
                        $data['info']= $e->getMessage();
		            }
//		            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
//                    echo "<script>alert('注册成功请等待审核');window.location.href=\"".U('Login/appdown')."\";</script>";
//                    exit;
                    $data['status']= 1;
                    $data['info']= "注册成功请等待审核";
                }else{
                    $data['status']= 3;
                    $data['info']= "操作失败，两次密码不一致";

                }
            }

            echo json_encode($data); exit;
        }
        $this->display();
    }

    //验证用户名密码正确性
    public function loginCheck(){
        $name = I("post.name");
        $password   = I("post.pass");
        $where['name']   = $name;
        //echo $password; exit;
        $where['password']  = md5(md5($password));
        $u = M('user')->where($where)
            ->find();
        if($u){
            if(!$u['encry']){
                $encry['encry'] =md5($name);
                M('user')->where(array('name'=>$name))->save($encry);
            }
            cookie("encry",$u['encry']);
            cookie("username",$name);
            cookie("login_time",time());
            $this->redirect("Home/user/lists");
        }else{
            $data['result'] = "error";
            $this->redirect("Home/Login/login");

        }
    }

    //下载
    public function appdown(){
        Header("Location: https://app.dg0123.net.cn/app/jiuwan/index.html"); exit;
        $this->display();
    }


}