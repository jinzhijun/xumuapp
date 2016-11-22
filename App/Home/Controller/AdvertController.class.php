<?php
namespace Home\Controller;
use Think\Controller;
use Common\ORG\Util\calendar;
class AdvertController extends BaseController {
    public function index(){
        $params = array();
        if (isset($_GET['year']) && isset($_GET['month'])) {
            $params = array(
                'year' => $_GET['year'],
                'month' => $_GET['month'],
            );
        }
        $params['url']  = 'index.php';
        $cal = new Calendar($params);
        $aa= $cal->display1();
        $bb= $cal->display2();
        $cc= $cal->display3();
        $dd= $cal->display4();
        $this->assign('aa',$aa);
        $this->assign('bb',$bb);
        $this->assign('cc',$cc);
        $this->assign('dd',$dd);
        $user= M('user')->where(array('name'=>$_GET['username']))->find();
        $this->assign('user',$user);
        $record= M('record')->where(array('name'=>$_GET['username']))->find();
        $this->assign('info',$record);
        $this->display();
    }
}


