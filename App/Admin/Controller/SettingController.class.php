<?php
namespace Admin\Controller;

use Think\Model;

class SettingController extends BaseController
{
    public function _initialize(){
        parent::_initialize();
        $this->uid = session('sid');
        $this->menu =  M('menu_admin');
        $this->admin = M('admin');
    }
     
    public function index()
    {
        $list = M('admin')->select();
        $this->assign("admins", $list);
        $this->assign("hoster", $_COOKIE['account']);
        $this->display();
    }
    public function save_data(){
        if($_POST['uid']){
    
            $a = $_POST['checkbox'];
             
            $b= implode(',',$a);
            
            $data['nav'] = $b;
             //dump(I("uid"));exit;
             $res = $this->admin->where(array('id'=> $_POST['uid']))->data($data)->save();
            if($res){
                 $this->success('操作成功');
            }else{
                $this->error('操作错误');
            }
            // $c = unserialize($b);
            // dump($c);
        }
    }
    public function operateParams()
    {
        //$setting = M("setting")->order("'group' asc ")->select();
        //$this->assign("params", $setting);
        
        $this->display();
    }
   
    // 保存参数
    public function saveParams()
    {
        if ($_REQUEST['name'] != '') {
            
            $setting = M("setting");
            
            $data['key'] = $_REQUEST['name'];
            $data['value'] = $_REQUEST['value'];
            $data['group'] = $_REQUEST['group'];
            $data['sort'] = $_REQUEST['sort'];
            $data['status'] = $_REQUEST['status'];
            
            if ($_REQUEST['id'] != '') {
                $where['id'] = $_REQUEST['id'];
                $result = $setting->where($where)
                    ->data($data)
                    ->save();
            } else {
                $result = $setting->data($data)->add();
            }
            
            if ($result) {
                $json['result'] = "success";
            } else {
                $json['result'] = "error";
            }
            
            $this->ajaxReturn($json);
        }
    }
    // 删除参数
    public function deleteParams()
    {
        if ($_REQUEST['id'] != '') {
            
            $setting = M("setting");
            
            $where['id'] = $_REQUEST['id'];
            
            $result = $setting->where($where)->delete();
        }
        if ($result) {
            $json['result'] = "success";
        } else {
            $json['result'] = "error";
        }
        
        $this->ajaxReturn($json);
    }
    public function area()
    {
        $area = M("city_area")->where("status=1")->select();
        
        $this->assign("areas", $area);
        $this->display();
    }


    public function power()
    {
        $system_module = M('system_menu')->select();
        
        $this->assign("system_module", $system_module);
        $this->display();
    }

	//删除会员
	public function deladmin(){
        $admin_id = I("power_id");
        $json = array();
        $admin_model = M("admin");
        $info = $admin_model->where(array('id'=>$admin_id))->find();
        if( empty($info) ){
        	$json['result'] = '3';
        }
        $del_result = $admin_model->where(array('id'=>$admin_id))->delete();
        if( $del_result !== false ){
        	$json['result'] = '1';
        }else{
        	$json['result'] = '2';
        }
        $this->ajaxReturn($json);
	}


    public function addPower()
    {
        if ($_REQUEST['name'] != '') {
            $system_menu = M("system_menu");
            $system_menu->create();
            
            $result = $system_menu->add();
            if ($result) {
                $json['result'] = "success";
            } else {
                $json['result'] = "error";
            }
            
            $this->ajaxReturn($json);
        }
        
        $this->display();
    }

    public function editpower()
    {
        if ($_REQUEST['action'] == 'update') {
            $where['id'] = $_REQUEST['id'];
            $system_menu = M('system_menu');
            
            $data['name'] = $_REQUEST['name'];
            $data['path'] = $_REQUEST['path'];
            $data['parent'] = $_REQUEST['parent'];
            $data['sort'] = $_REQUEST['sort'];
            $data['status'] = $_REQUEST['status'];
            $data['is_menu'] = $_REQUEST['is_menu'];
            
            $result = $system_menu->where($where)
                ->data($data)
                ->save();
            
            if ($result) {
                $json['result'] = "success";
            } else {
                $json['result'] = "error";
            }
            
            $this->ajaxReturn($json);
        }
        $where['id'] = $_REQUEST['id'];
        
        $system_menu = M('system_menu')->where($where)->find();
        $this->assign("power", $system_menu);
        
        $system_module = M('system_menu')->select();
        $this->assign("system_module", $system_module);
        
        $this->display();
    }

    public function delPower()
    {
        if ($_REQUEST['id'] != '') {
            $system_menu = M("system_menu");
            
            $where['parent'] = $_REQUEST['id'];
            
            $result = $system_menu->where($where)->find();
            
            if ($result) {
                $json['result'] = "error";
                $json['msg'] = '有下级模块，不能删除';
                
                $this->ajaxReturn($json);
            } else {
                
                $whereDel["id"] = $_REQUEST['id'];
                $resultDel = $system_menu->where($whereDel)->delete();
                
                if ($resultDel) {
                    $json['result'] = "success";
                } else {
                    $json['result'] = "error";
                }
                
                $this->ajaxReturn($json);
            }
        }
    }

    public function role()
    {
        $roles = M("admin_role")->select();
        $this->assign("roles", $roles);
        $this->display();
    }

    public function addRole()
    {
        if ($_REQUEST['name'] != '') {
            
            $role = M("admin_role");
            $role->create();
            
            $result = $role->add();
            if ($result) {
                $json['result'] = "success";
            } else {
                $json['result'] = "error";
            }
            
            $this->ajaxReturn($json);
        }
        
        $this->display();
    }

    public function editRole()
    {
        if ($_REQUEST['action'] == 'update') {
            $where['id'] = $_REQUEST['id'];
            $role = M('admin_role');
            
            $data['name'] = $_REQUEST['name'];
            
            $data['status'] = $_REQUEST['status'];
            
            $result = $role->where($where)
                ->data($data)
                ->save();
            
            if ($result) {
                $json['result'] = "success";
            } else {
                $json['result'] = "error";
            }
            
            $this->ajaxReturn($json);
        } else 
            if ($_REQUEST['id'] != '') {
                
                $role = M('admin_role')->where("id=" . $_REQUEST['id'])->find();
                $this->assign("role", $role);
            }
        
        $this->display();
    }

    public function setpower()
    {
        $id = I('id');
        if ($id) {
            //$where['id'] = $_REQUEST['id'];
            $res = $this->admin->where(array('id'=> $id ))->find();
            $nav = ($res['nav']);
            $this->assign("uid", $id);
            $c = explode(',',$nav);
           
            $power = explode(',', $res['nav']);
            $this->assign("power", $power);
            $system_module = M('menu_admin')->select();
            $this->assign("system_module1", $system_module);
        }
        $this->display();
    }



    public function add()
    {
        if ($_POST) {
            
            $admin = M("admin");
            $account = I('account');
            $res = $admin->where(array('account'=>$account))->select();
            if($res){
              $json['resultr'] = "error";
              
            }else{
                $account = I('account');
                $data['account'] = $account;
                $data['real_name'] = I('real_name');
                $data['status'] = I('status');
                $data['password'] = md5(md5(I('password')));
                $result = $admin->data($data)->add();
                  if($result) {
                      $json['result'] = "success2";
                  }else {
                      $json['result'] = "error";
                  }
            }
           
            
            $this->ajaxReturn($json);
        } else {
           // $roles = M("admin_role")->select();
          //  $this->assign("roles", $roles);
            
            $this->display();
        }
    }

    public function edit()
    {
        $where['id'] = I('id');
        if ($_POST) {
            $where['id'] = I('id');
           //dump(I('id')); 
            $admin = M('admin');
            $data = array();
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info=$upload->upload();
             
            if($info){
            	$data['head'] = "/Uploads/".$info['certificate']['savepath'] . $info['certificate']['savename'];

            }
            $data['real_name'] = $_REQUEST['real_name'];
            $data['account'] = $_REQUEST['account1'];
           // $data['role_id'] = $_REQUEST['role_id'];
            $data['status'] = $_REQUEST['status'];
          //  dump($data);exit;
            $result = M('admin')->where($where)->data($data)->save();
            if($result){
            	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            	echo "<script>alert('操作成功');window.location.href=\"".U( CONTROLLER_NAME . '/index')."\";</script>";exit;
            
            }else{
            	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            	echo "<script>alert('操作失败');window.location.href=\"".U( CONTROLLER_NAME . '/index')."\";</script>";exit;
            
            }
           
            
            $this->ajaxReturn($result);
        } else 
            if ($_REQUEST['id'] != '') {
                
                $admin = M('admin')->where($where)->find();
                $this->assign("admin", $admin);
            }
        
      //  $roles = M("admin_role")->select();
      //  $this->assign("roles", $roles);
        
        $this->display();
    }

    public function setAdminPassword()
    { $where['id'] = I('id');
        if ($_REQUEST['action'] == 'password') {
            $where['id'] = I('id');
            $admin = M('admin');
            
            $data['password'] = md5(I('password'));
            
            $result = $admin->where($where)
                ->data($data)
                ->save();
            
            if ($result) {
                $json['result'] = "success";
            } else {
                $json['result'] = "error";
            }
            
            $this->ajaxReturn($json);
        } else 
            if ($_REQUEST['id'] != '') {
                
                $admin = M('admin')->where($where)->find();
                $this->assign("admin", $admin);
                
                $this->display();
            }
    }

    public function getArea()
    {
        $where['status'] = 1;
        
        if ($_REQUEST['parent_code'] != '') {
            $where['parent_code'] = $_REQUEST['parent_code'];
        } else {
            $where['parent_code'] = array(
                "exp",
                "is null"
            );
        }
        
        $area = M("city_area")->where($where)->select();
        
        $json["result"] = $area;
        
        $this->ajaxReturn($json);
    }
//-----------------------------板块------------------------------
    public function Plate()
    {
        $this->display('setting/plate/plate');
    }
    // 添加板块
    public function addPlate()
    {
        $regional_plate = $_POST['regional_plate'];
        if ($_POST['regional_plate'] != '') {
            $plate = M("plate");
            $count = $plate->where('regional_plate=' . "'" . $regional_plate . "'")->count();
            if ($count == 0) {
                $plate->create();
                $result = $plate->add();
                if ($result) {
                    $json['result'] = "success";
                } else {
                    $json['result'] = "error";
                }
                $this->ajaxReturn($json);
            } else 
                if ($count != 0) {
                    $json['result'] = "error";
                    $this->ajaxReturn($json);
                }
        } else {
            $this->display("/setting/plate/addPlate");
        }
    }
    // 查询需要编辑的板块在前端显示
    public function editPlate()
    {
        $plateID = $_GET['id'];
        $plate = M('plate');
        $data = $plate->where('id=' . $plateID)->find();
        $this->assign('result', $data);
        $this->assign('id', $plateID);
        $this->display('setting/plate/editPlate');
    }

    public function ajaxPlate()
    {
        $plateID = $_POST['plateId'];
        $cz = $_POST['cz'];
        
        if ($cz == '') {
            $plate = M('plate')->select();
            $result['result'] = json_encode($plate);
            $this->ajaxReturn($result);
        } else 
            if ($cz == 'edit') { // 编辑板块
                $data = $_POST['data'];
                $id = $_POST['id'];
                $plate = M('plate');
                $res=$plate->execute("update plate set regional_plate='" . $data . "' where id=" . $id);
//                 $res=$plate->where('id='.$id)->save($data);
                if ($res) {
                    $result['result'] = 'success';
                } else {
                    $result['result'] = 'error';
                }
                $this->ajaxReturn($result);
            } else 
                if ($cz == 'del') { // 删除板块
                    $proExit = M('project');
                    $proExit->execute("update project set plateId=null where plateId=" . $plateID);
                    $plate = M('plate');
                    $plate->where('id=' . $plateID)->delete();
                    if ($plate) {
                        $result['result'] = 'success';
                    } else {
                        $result['result'] = 'error';
                    }
                    $this->ajaxReturn($result);
                }
    }
//-----------------------自定义板块-----------------------------
    public function userPlate()
    {
        $this->display('setting/plate/userPlate');
    }
    // 添加板块
    public function addUserPlate()
    {
        $regional_plate = $_POST['regional_plate'];
        if ($_POST['regional_plate'] != '') {
            $plate = M("plate_user");
            $count = $plate->where('regional_plate=' . "'" . $regional_plate . "'")->count();
            if ($count == 0) {
                $plate->create();
                $result = $plate->add();
                if ($result) {
                    $json['result'] = "success";
                } else {
                    $json['result'] = "error";
                }
                $this->ajaxReturn($json);
            } else
                if ($count != 0) {
                    $json['result'] = "error";
                    $this->ajaxReturn($json);
                }
        } else {
            $this->display("/setting/plate/addUserPlate");
        }
    }
    // 查询需要编辑的板块在前端显示
    public function editUserPlate()
    {
        $plateID = $_GET['id'];
        $plate = M('plate_user');
        $data = $plate->where('id=' . $plateID)->find();
        $this->assign('result', $data);
        $this->assign('id', $plateID);
        $this->display('setting/plate/editUserPlate');
    }
    
    public function ajaxUserPlate()
    {
        $plateID = $_POST['plateId'];
        $cz = $_POST['cz'];
    
        if ($cz == '') {
            $plate = M('plate_user')->select();
            $result['result'] = json_encode($plate);
            $this->ajaxReturn($result);
        } else
            if ($cz == 'edit') { // 编辑板块
            $data = $_POST['data'];
            $id = $_POST['id'];
            $plate = M('plate_user');
            $res=$plate->execute("update plate_user set regional_plate='" . $data . "' where id=" . $id);
            //                 $res=$plate->where('id='.$id)->save($data);
            if ($res) {
                $result['result'] = 'success';
            } else {
                $result['result'] = 'error';
            }
            $this->ajaxReturn($result);
        } else
            if ($cz == 'del') { // 删除板块
//             $proExit = M('project');
//             $proExit->execute("update project set plateId=null where plateId=" . $plateID);
            $plate = M('plate_user');
            $plate->where('id=' . $plateID)->delete();
            if ($plate) {
                $result['result'] = 'success';
            } else {
                $result['result'] = 'error';
            }
            $this->ajaxReturn($result);
        }
    }
}