<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class ProOrderController extends BaseController {
    public $previous;
    public function _initialize(){
        parent::_initialize();
        //模型初始化
        $this->previous = D('ProOrder');
    }
    //首页
    public function gindex(){
        $where = "";
        $name = I('name');
        //搜索
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->previous->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res = $this->previous->where($where)
            ->order('id ASC')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach($res  as $k=>$v){
            $pro= M('Product')->where(array('id'=>$v['pro_id']))->find();
            $res[$k]['proname'] = $pro['name'];
        }
        //视图展示数据集
        $this->assign('page', $page->show());
        $this->assign('name',$name);
        $this->assign('list',$res);
        $this->display();
    }
    //主页删除
    public function gdelete_data(){
        $list = $_REQUEST['list'];
        if($list){
            $var=explode(",",$list);
            foreach ($var as $k=>$v){
                $res = $this->previous->where(array('id'=>$v))->delete();
                if($res){
                    $this->success('操作成功',U(CONTROLLER_NAME.'/gindex'));
                }
                else{
                    $this->error('操作失败',U(CONTROLLER_NAME.'/gindex'));
                }
            }
        }else{
            $where['id'] = $_REQUEST['id'];
            $res = $this->previous->where($where)->delete();
            if($res){
                $this->success('操作成功',U(CONTROLLER_NAME.'/gindex'));
            }
            else{
                $this->error('操作失败',U(CONTROLLER_NAME.'/gindex'));
            }
        }
    }
    //订单收货状态修改
    public function gshow_change(){
        $res =$this->previous
            ->where(array('id' => $_REQUEST['id']))
            ->save(array('type'=>$_REQUEST['status']));
        if ($res) {
            echo "修改完成";
        }
        else {
            echo "修改失败";
        }
    }

    //快递公司和编号
    public function order_change(){
        $where['id'] = $_REQUEST['id'];
        $note['note'] = $_REQUEST['note'];
        $res= $this->previous->where($where)->save($note);
        if($res){
            $arr['info']= '修改成功';
            echo json_encode($arr); exit;
        }else{
            $arr['status']= 0;
            $arr['info']= '修改失败';
            echo json_encode($arr); exit;
        }
    }


}