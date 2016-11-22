<?php
namespace Home\Controller;
use Think\Controller;
class WinController extends BaseController {
    //今日提成明细
    public function index(){
        $where = '';
        $username = $_GET['username'];
        $where['username'] = $username;
        $strtime= strtotime(date('Y-m-d'));
        $endtime= strtotime(date('Y-m-d'))+86400;
        $where['date']= array('between',"$strtime,$endtime");
        $forward= M('forward_sign')->where($where)->select();
        $count= M('forward_sign')->where($where)->count();
        $total_money=0;
        foreach($forward as $k=>$v){
            $total_money += $v['money'];
        }
        $this->assign('total_money',$total_money);
        $this->assign('count',$count);
        $this->assign('list',$forward);
        $this->display();
    }
}


