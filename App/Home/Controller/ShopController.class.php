<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends BaseController {
    function _initialize(){
        //type  1 手动添加   2 是生日积分  3大转盘 4 商城积分兑换商品积分  5 业务积分转化商城积分 6 广告积分
        $this->Model = D('Product');
        $this->Pro= M('Pro_class');
    }
    //商城首页
    public function index(){
        $where = '';
        $name = I('name');
        if($name){
            $where['name'] = array("like","%".$name."%");
        }
        $res =$this->Model->order('id asc')->where($where)
            ->select();
        $this->assign('list',$res);
        $this->display();
  }

    //商城分类页面
    public function category(){
        $res =$this->Pro->order('id asc')->select();
        $this->assign('list',$res);
        $this->display();
    }


    //商品搜索页面
    public function search(){
        $keywords= $_GET['keywords'];
        if($keywords){
            $where['name'] = array("like","%".$keywords."%");
        }
        $cid= $_GET['cid'];
        if($cid){
            $where['class'] = $cid;
        }

        $bid= $_GET['bid'];
        if($bid){
            $where['bid'] = $bid;
        }
        $sort= $_GET['sort'];
        if($sort){
            $order = $sort.' '.$_GET['order'];
        }

        $price_min= $_GET['price_min'];
        $price_max= $_GET['price_max'];
        if($price_min || $price_max){
            $where['shop_price'] = array('between',array($price_min,$price_max));
        }
        $pro_list= M('Product')->where($where)->order($order)->select();

        $this->assign('list',$pro_list);
        $this->display();
    }


    //商城详情页面
    public function detail(){
        $pro= $this->Model->where(array('id'=>$_GET['id']))->find();
        $pro_img= M('Pro_img')->where(array('p_id'=>$_GET['id']))->select();
        $likes= M('Pro_likes')->where(array('pid'=>$_GET['id'],'username'=>$_GET['username']))->find();
        $this->assign('likes',$likes);
        $this->assign('pro',$pro);
        $this->assign('pro_img',$pro_img);
        $this->display();
    }


    //商品喜欢
    public function likes(){
        if($_POST['num']==1){
            $data['pid']= $_GET['id'];
            $data['username']= $_POST['username'];
            $rs= M('Pro_likes')->add($data);
            if($rs){
                M('Product')->where(array('id'=>$_GET['id']))->setInc('likes');
            }
            $info= 1;
        }else{

            $where['pid']= $_GET['id'];
            $where['username']= $_POST['username'];
            $rs= M('Pro_likes')->where($where)->delete();
            if($rs){
                M('Product')->where(array('id'=>$_GET['id']))->setDec('likes');
            }
            $info= 2;
        }
        echo json_encode($info); exit;
    }

    //下单页面
    public function checkout(){
        $number=  I('post.number');
        $pro= $this->Model->where(array('id'=>I('post.id')))->find();
        $pro['price'] = $pro['shop_price']*$number;
        $this->assign('pro',$pro);
        $this->assign('number',$number);
        $this->display();
    }

    //订单提交
    public function suborder(){
       $user=  M('user')->where(array('name'=>$_GET['username']))->find();
       $pro= M('Product')->where(array('id'=>$_POST['id']))->find();
        if($user['shop_sign']>($pro['shop_price']*$_POST['number'])){
            $info['pro_id']  = $_POST['id'];
            $info['name']  = $_POST['name'];
            $info['tel']  = $_POST['tel'];
            $info['province']  = $_POST['province'];
            $info['city']  = $_POST['city'];
            $info['area']  = $_POST['area'];
            $info['area']  = $_POST['area'];
            $info['address']  = $_POST['address'];
            $info['text']  = $_POST['text'];
            $info['count']  = $_POST['number'];
            $info['username']  = $_GET['username'];
            $info['order_id']  = uniqid();
            $info['date']  = time();
            $info['total']  = $_POST['number']*$pro['shop_price'];
            $rs=  M('Pro_order')->add($info);
            if($rs){
                M('Product')->where(array('id'=>$_POST['id']))->setInc('sale');
                $res = M('User')->where(array('name'=>$_GET['username']))->setDec('shop_sign',$info['total']);
                if($res){
                    $info['username']= $_GET['username'];
                    $info['sign']= -$info['total'];
                    $info['date']= time();
                    $info['type']=4;//商城积分兑换商品
                    M('sign')->add($info);
                }
                $data['info'] = "订单提交成功";
                $data['status']= 1;
            }else{
                $data['info'] = "提交失败请稍后再试";
                $data['status']= 2;
            }
        }else{
            $data['info'] = "积分不足";
            $data['status']= 3;
        }
        echo json_encode($data); exit;
    }

    //订单列表
    public function order_list(){
        $where['username']= $_GET['username'];
        $order= M('Pro_order')->where($where)->select();
        foreach($order as $k=>$v){
            $pro =$this->Model->where(array('id'=>$v['pro_id']))->find();
            $order[$k]['proname']= $pro['name'];
            $order[$k]['primg']= $pro['main_img'];
        }
        $this->assign('list',$order);
        $this->display();
    }


    //订单详情
    public function order_detail(){
        $where['username']= $_GET['username'];
        $where['id']= $_GET['id'];
        $order= M('Pro_order')->where($where)->find();

        $pro =$this->Model->where(array('id'=>$order['pro_id']))->find();
        $this->assign('pro',$pro);
        $this->assign('order',$order);
        $this->display();
    }


    //积分转化
    public function exchange(){
        $user= M('user')->where(array('name'=>$_GET['username']))->find();
        if(IS_POST){
            if($user['total_score']<$_POST['num']){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('您输入的兑换积分超过您的实际积分积分兑换');window.location.href=\"".U( 'Shop/exchange',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }
            $sign['shop_sign'] =$user['shop_sign']+ $_POST['num'];
            $sign['total_score'] =$user['total_score']- $_POST['num'];
            $res = M('user')->where(array('name'=>$_GET['username']))->save($sign);
            if($res){
                $info['username']=$_GET['username'];
                $info['sign']= -$_POST['num'];
                $info['date']= time();
                $info['type']= 5;//业务积分转化为商城积分
                M('sign')->add($info);
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('积分兑换成功');window.location.href=\"".U( 'Shop/exchange',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('积分兑换失败，请稍后再试');window.location.href=\"".U( 'Shop/exchange',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }
        }
        $this->assign('user',$user);
        $this->display();
    }

        //积分充值
    public function account_deposit(){
        if(IS_POST){
            $user= M('user')->where(array('name'=>$_GET['username']))->find();
            $data['money'] = $_POST['money'];
            $data['text'] = $_POST['text'];
            $data['date'] = time();
            $data['username'] = $_GET['username'];
            $data['type'] = 2;//充值
            $data['status'] = 0;//1是审核通过0未审核3审未通过
            $rs = M('money')->add($data);
            if ($rs) {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('申请成功');window.location.href=\"" . U('Shop/account_deposit', array('username' => $_GET['username'], 'encry' => $_GET['encry'])) . "\";</script>";
                exit;
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('申请失败，请稍后再试！');window.location.href=\"" . U('Shop/account_deposit', array('username' => $_GET['username'], 'encry' => $_GET['encry'])) . "\";</script>";
                exit;
            }
        }

        $where['type'] =2;
        $res = M('Money')->order('id asc')->where($where)
            ->select();
        $this->display();
    }

    //申请记录
    public function account_log(){
        $user= M('user')->where(array('name'=>$_GET['username']))->find();
        $res = M('Money')->order('id asc')->select();
        $this->assign('list',$res);
        $this->assign('user',$user);
        $this->display();

    }

    //提现
    public function account_raply(){
        if(IS_POST){
            $user= M('user')->where(array('name'=>$_GET['username']))->find();
            if($_POST['money'] < 5600){
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('提现金额小于5600');window.location.href=\"".U( 'Shop/account_raply',array('username'=>$_GET['username'],'encry'=>$_GET['encry']))."\";</script>";
                exit;
            }else {
                if ($user['total_money'] < $_POST['money']) {
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('资金不足');window.location.href=\"" . U('Shop/account_raply', array('username' => $_GET['username'], 'encry' => $_GET['encry'])) . "\";</script>";
                    exit;
                }
                $data['money'] = $_POST['money'];
                $data['text'] = $_POST['text'];
                $data['date'] = time();
                $data['username'] = $_GET['username'];
                $data['type'] = 1;//提现
                $data['status'] = 0;//1是审核通过0未审核3审未通过
                $rs = M('money')->add($data);
                if ($rs) {
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('申请成功');window.location.href=\"" . U('Shop/account_raply', array('username' => $_GET['username'], 'encry' => $_GET['encry'])) . "\";</script>";
                    exit;
                }else{
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                    echo "<script>alert('申请失败，请稍后再试！');window.location.href=\"" . U('Shop/account_raply', array('username' => $_GET['username'], 'encry' => $_GET['encry'])) . "\";</script>";
                    exit;
                }
            }
        }
        $where['type'] =1;
        $res = M('Money')->order('id asc')->where($where)
            ->select();
        $this->display();
    }


    //查看账户信息
    public function capital(){

        $where['name']= $_GET['username'];
        $order= M('user')->where($where)->find();

        $this->assign('list',$order);
        $this->display();
    }


}


