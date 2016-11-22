<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * QQ: 879461667
 * Date: 2016/1/28
 * Time: 13:53
 */

namespace Admin\Controller;
use Think\Controller;
use Common\ORG\Util\Page;
class AttentionController extends BaseController {
    public $Model;
    public $user;
    function _initialize(){
        $this->Model = M('attention');
        $this->user = M('user');
    }
    //首页
    public function index(){
        $where = '';
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $count = $this->user->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        $res =$this->user->field('id,name,head')->order('id asc')->where($where)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach($res as $k=>$v){
            $cont = $this->Model->where(array('usid'=>$v['id']))->select();
            $res[$k]['count'] = count($cont);
        }
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->display();
    }
    //查看单个会员关注产品详情
    public function check(){
        $where['usid'] = I('id');
        $where1['id'] = I('id');
        //查询当前会员的名称
        $user = $this->user->field('id,name')->where($where1)->find();
        //查询当前会员关注的产品id
        $res = $this->Model->where($where)->select();
        $proList = array();
       foreach($res as $k=>$v){
           //根据会员关注产品id查询产品
           $pro = M("product")
               ->where(array("id"=>$v['pid'],"status"=>1))
               ->order('id asc')
               ->select();
           foreach($pro as $k1=>$v1){
               //根据产品id查询产品分类
               $class = D('ProClass')->pc_getone(array('id'=>$v1['class']));
               $proList[$k] = $v1;
               $proList[$k]['gdate'] = $v['date'];
               $proList[$k]['class'] = $class['name'];
           }
       }
        $this->assign('user',$user);
        $this->assign('list',$proList);
        $this->display();
    }
    //关注产品
    public function attention(){
        $where['pid'] = I("id");
        $where['usid'] = 1361;
        $find = M("attention")->where($where)->select();
        if(count($find) == 0){
            $data['usid'] = 1361;
            $data['pid'] = I("id");
            $data['date'] = time();
            $res = M("attention")->add($data);
            if($res > 0){
                $json['result'] = 'success';
            }else{
                $json['result'] = 'error';
            }
        }else {
            $json['result'] = 'error1';
        }
        $this->ajaxReturn($json);
    }
}