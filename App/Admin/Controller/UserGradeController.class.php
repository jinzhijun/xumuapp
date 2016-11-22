<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class UserGradeController extends BaseController {
    public $model;
    public function _initialize(){
        parent::_initialize();
        //初始化模型
        $this->model = D('UserGrade');
    }
    //首页
    public function index(){
        //$a = $this->model->GetOne(array('id'=>1));
       // dump($a);
        $where = "";
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->model->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->model->GetList($where,'id ASC','*',$page->firstRow.','.$page->listRows);
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->display();
    }
    //删除
    public function delete_data(){
        //批量删除
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->model->DelData(array('id'=>$v));
               if($res){
                   $json['result'] = 'success1';
               }
               else{
                   $json['result'] = 'error';
               }
           }
        }else{
            //单条删除
            $where['id'] = $_REQUEST['id'];
            $res = $this->model->DelData($where);
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
         }
        $this->ajaxReturn($json);
     }
    //编辑
    public function EditData() {
        if($_POST){
            $where['id'] = I('id');
            $data['name'] = I('name');
            $data['sort'] = I('sort');
            $data['date'] = time();
            $res = $this->model->SaveData($where,$data);
            if($res == true){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('修改成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('".$this->user->getError()."修改失败')";exit;
            }
        }
        $where['id'] = $_REQUEST['id'];
        $res = $this->model->GetOne($where);
        $this->assign('list',$res);
        $this->display('add');
    }
    //状态修改
    public function show_change(){
        $res = $this->model->SaveData(array('id' => $_REQUEST['id']),array('status'=>$_REQUEST['status']));
    }
    //添加
    public function add(){
        if($_POST){
            if(I('name')){
                $findone = $this->model->GetOne(array('name'=>I('name')));
                if(!empty($findone)){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('已有的分类名称，请重新输入！');</script>";
                    $this->display();
                    exit;
                }else{
                    $data['name'] = I('name');
                }
            }
            $data['sort'] = I('sort');
            $data['date'] = time();
            $res = $this->model->AddData($data);
            if($res == true){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('添加成功');window.location.href=\"".U(CONTROLLER_NAME . '/index')."\";</script>";exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('".$this->user->getError()."添加失败')";exit;
            }
        }
        $this->display();
    }

}