<?php
namespace Home\Controller;
use Think\Controller;
class ExpendController extends BaseController {
    public function index(){
        $where = '';
        $username = $_GET['username'];
        $where['username'] = $username;
        $strtime= strtotime(date('Y-m-d'));
        $endtime= strtotime(date('Y-m-d'))+86400;
        $where['date']= array('between',"$strtime,$endtime");
        $where['type']= 1;
        $add_points= M('sign')->where($where)->sum('sign');

        $where['type']= 2;
        $shengri= M('sign')->where($where)->sum('sign');



        $where['type']= 3;
        $choujiang= M('sign')->where($where)->sum('sign');



        $where['type']= 4;
        $shangcheng= M('sign')->where($where)->sum('sign');



        $where['type']= 5;
        $yewu= M('sign')->where($where)->sum('sign');


        $where['type']= 6;
        $guanggao= M('sign')->where($where)->sum('sign');

        if(!$add_points){
            $add_points=0;
        }
        $this->assign('add_points',$add_points);


        if(!$shengri){
            $shengri=0;
        }
        $this->assign('shengri',$shengri);

        if(!$choujiang){
            $choujiang=0;
        }
        $this->assign('choujiang',$choujiang);

        if(!$shangcheng){
            $shangcheng=0;
        }
        $this->assign('shangcheng',$shangcheng);

        if(!$yewu){
            $yewu=0;
        }
        $this->assign('yewu',$yewu);

        if(!$guanggao){
            $guanggao=0;
        }
        $this->assign('guanggao',$guanggao);

        $this->display();
  }
}


