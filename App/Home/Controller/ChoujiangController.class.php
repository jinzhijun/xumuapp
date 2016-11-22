<?php
namespace Home\Controller;
use Think\Controller;
class ChoujiangController extends BaseController {
    public function index(){
        $res =M('Choujiang')->order('id desc')
            ->find();

        $win =M('Choujiang_win')->where(array('pid'=>$res['id']))
            ->select();

        $user =M('User')->where(array('name'=>$_GET['username']))
            ->find();
        $this->assign('win',$win);
        $this->assign('list',$res);
        $this->assign('user',$user);
        $this->display();
    }

    public function info(){
        $choujiang   = M('Choujiang')->where(array('id'=>$_GET['id'],'enddate'=>array('GT',time()),'strdate'=>array('LT',time())))->find();
        //活动未开始或已结束
        if(!$choujiang){
                $data['status']= "0";
                $data['info']="活动未开始或已经结束";
               echo  json_encode($data); exit;
        }
        $user =M('User')->where(array('name'=>$_GET['username']))
            ->find();
        //积分不足
        if($user['total_score']<$choujiang['sign']){
            $data['status']= "0";
            $data['info']="积分不足";
            echo  json_encode($data); exit;
        }
        $res = M('User')->where(array('name'=>$_GET['username']))->setDec('total_score',$choujiang['sign']);
        if($res){
            $info['username']= $_GET['username'];
            $info['sign']= -$choujiang['sign'];
            $info['date']= time();
            $info['type']= 3;//1是手动添加2 是签到3是大转盘
            M('sign')->add($info);
        }
        $firstNum   = intval($choujiang['fistnums']);
        $secondNum  = intval($choujiang['secondnums']);
        $thirdNum   = intval($choujiang['thirdnums']);
        $fourthNum  = intval($choujiang['fournums']);
        $fifthNum   = intval($choujiang['fivenums']);
        $prize_arr = array(
            '0' => array('id'=>2,'prize'=>'一等奖','v'=>$firstNum,'start'=>0,'end'=>$firstNum),
            '1' => array('id'=>4,'prize'=>'二等奖','v'=>$secondNum,'start'=>$firstNum,'end'=>$firstNum+$secondNum),
            '2' => array('id'=>6,'prize'=>'三等奖','v'=>$thirdNum,'start'=>$firstNum+$secondNum,'end'=>$firstNum+$secondNum+$thirdNum),
            '3' => array('id'=>8,'prize'=>'四等奖','v'=>$fourthNum,'start'=>$firstNum+$secondNum+$thirdNum,'end'=>$firstNum+$secondNum+$thirdNum+$fourthNum),
            '4' => array('id'=>10,'prize'=>'五等奖','v'=>$fifthNum,'start'=>$firstNum+$secondNum+$thirdNum+$fourthNum,'end'=>$firstNum+$secondNum+$thirdNum+$fourthNum+$fifthNum)
        );
        //
        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val;
        }
        //print_r($arr); exit;
        //-------------------------------
        //随机抽奖[如果预计活动的人数为1为各个奖项100%中奖]
        //-------------------------------

        $prizetype = $this->get_rand($arr,intval($choujiang['num']));

        switch($prizetype){
            case 2:
                if ($choujiang['fistlucknums'] >= $choujiang['fistnums']) {
                    $prizetype = '7';

                }
                else {
                    if(empty($choujiang['fist']) && empty($choujiang['fistnums'])){
                        $prizetype = '7';

                    }
                    else { //输出中了二等奖
                        $prizetype = 2;
                        $winprize = $choujiang['fist'];
                        M('Choujiang')->where(array('id'=>$_GET['id']))->setInc('fistlucknums');
                    }
                }
                break;

            case 4:
                if ($choujiang['secondlucknums'] >= $choujiang['secondnums']) {
                    $prizetype = '7';
                    //$winprize = '谢谢参与';
                }
                else {
                    //判断是否设置了2等奖&&数量
                    if(empty($choujiang['second']) && empty($choujiang['secondnums'])){
                        $prizetype = '7';
                        //$winprize = '谢谢参与';
                    }
                    else { //输出中了二等奖
                        $prizetype = 4;
                        $winprize = $choujiang['second'];
                        M('Choujiang')->where(array('id'=>$_GET['id']))->setInc('secondlucknums');
                    }
                }
                break;

            case 6:
                if ($choujiang['thirdlucknums'] >= $choujiang['thirdnums']) {
                    $prizetype = '7';

                    // $winprize = '谢谢参与';
                }
                else {
                    if(empty($choujiang['third']) && empty($choujiang['thirdnums'])){
                        $prizetype = '7';
                        // $winprize = '谢谢参与';
                    }
                    else{
                        $prizetype = 6;
                        $winprize = $choujiang['third'];
                        M('Choujiang')->where(array('id'=>$_GET['id']))->setInc('thirdlucknums');
                    }
                }
                break;

            case 8:
                if ($choujiang['fourlucknums'] >= $choujiang['fournums']) {
                    $prizetype =  '7';
                    // $winprize = '谢谢参与';
                }
                else {
                    if(empty($choujiang['four']) && empty($choujiang['fournums'])){
                        $prizetype =  '7';
                        //$winprize = '谢谢参与';
                    }
                    else{
                        $prizetype = 8;
                        $winprize = $choujiang['four'];
                        M('Choujiang')->where(array('id'=>$_GET['id']))->setInc('fourlucknums');
                    }
                }
                break;

            case 10:
                if ($choujiang['fivelucknums'] >= $choujiang['fivenums']) {
                    $prizetype =  '7';
                    //$winprize = '谢谢参与';
                }
                else {
                    if(empty($choujiang['five']) && empty($choujiang['fivenums'])){
                        $prizetype =  '7';
                        //$winprize = '谢谢参与';
                    }
                    else{
                        $prizetype = 10;
                        $winprize = $choujiang['five'];
                        M('Choujiang')->where(array('id'=>$_GET['id']))->setInc('fivelucknums');
                    }
                }
                break;
            default:
                $prizetype =  '7';
                //$winprize = '谢谢参与';
                break;
        }

        if($prizetype!=7){
            $win['date'] =time();
            $win['prize'] =$winprize;
            $win['pid'] =$_GET['id'];
            $win['username'] =$_GET['username'];
            M('Choujiang_win')->add($win);
        }
        $data['status']= 1;
        $data['zhong']=$prizetype;
        echo  json_encode($data); exit;
    }

    /**
     * Enter description here...
     *
     * @param unknown_type $proArr
     * @param unknown_type $total 预计参与人数
     * @return unknown
     */
    protected function get_rand($proArr,$total) {
        $result = 7;
        $randNum = mt_rand(1, $total);
        foreach ($proArr as $k => $v) {
            if ($v['v']>0){//奖项存在或者奖项之外
                if ($randNum>$v['start']&&$randNum<=$v['end']){
                    $result=$k;
                    break;
                }
            }
        }
        return $result;
    }




}


