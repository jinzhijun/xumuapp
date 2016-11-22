<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class LiveclassController extends BaseController {
    public $user;
    public function _initialize(){
        parent::_initialize();
        $this->liveclass = M('liveclass');
    }
    public function index(){
        $name = I('name');
        $where = "";
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
         
        $count = $this->liveclass->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->liveclass->where($where)->order('sort ASC')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->display();
    }
    public function search(){
         
        $where['name'] = array("like", "%" . I('get.name') . "%");
        $res = $this->liveclass->where($where)
        ->order('sort ASC')
        ->select();
        $this->assign('list',$res);
        $this->display('list_previous');
    }
    public function list_previous(){
        
    }
    public function previous_delete(){
        
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
             foreach ($var as $k=>$v){
               $res = $this->liveclass->where(array('id'=>$v))->delete();
               if($res){
                   $json['result'] = 'success1';
               }
               else{
                   $json['result'] = 'error';
               }
           }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->liveclass->where($where)->delete();
            if($res){
                $json['result'] = 'success';
            }
            else{
                $json['result'] = 'error';
            }
         }
        $this->ajaxReturn($json);
     }
    public function previous_save() {
        $data['sex'] = $_REQUEST['sex'];
        $data['birthday'] = $_REQUEST['birthday'];
        $where['id'] = $_REQUEST['id'];
        $data['mobile'] = $_REQUEST['mobile'];
        $data['truename'] = $_REQUEST['truename'];
         $data['name'] = $_REQUEST['name'];
        $data['sort'] = $_REQUEST['sort'];
        $data['status'] = I('status') == true ? 1:0;;
        $data['edit_time'] = time();
        $res = $this->liveclass
        ->where($where)
        ->data($data)
        ->save();
        if($res){
            $json['result'] = 'success';
        }
        else{
            $json['result'] = 'error';
        }
        $this->ajaxReturn($json);
    }
    public function save_data() {
        
        $where['id'] = $_REQUEST['id'];
        $res = $this->liveclass->where($where)->find();
        $this->assign('list',$res);
        $this->display('add');
    }
    public function show_change(){  
         $res = $this->liveclass
         ->where(array('id' => $_REQUEST['id']))
         ->save(array('status'=>$_REQUEST['status']));
    }
    public function add(){
        $this->display();
    }
    public function add_data(){
        $data['sex'] = $_REQUEST['sex'];
        $data['birthday'] = $_REQUEST['birthday'];
        $data['mobile'] = $_REQUEST['mobile'];
        $data['truename'] = $_REQUEST['truename'];
        $data['name'] = $_REQUEST['name'];
        $data['sort'] = $_REQUEST['sort'];
        $data['status'] = I('status') == true ? 1:0;;
        $data['create_time'] = time();
        $res = $this->liveclass->data($data)->add();
        if($res){
            $json['result'] = 'success';
        }
        else{
            $json['result'] = 'error';
        }
        $this->ajaxReturn($json);
    }
}