<?php
namespace Common\ORG\Util;
/*
	Author by y_jgs
	Tel:18765218752
*/
class Video{
	private $url;
	private $AppKey = "a16591d509f8243865119784690d833a";
	private $AppSecret = "ff0f68aa0320";
	private $post_data;
	
	private $Nonce;
	private $CurTime;
	private $CheckSum;
	
	//初始化
	public function __construct($url,$post_data){
		if( $url ){
			$this->url = $url;
		}else{
			return "空连接";
		}
		if( $post_data ){
			$this->post_data = $post_data;
		}else{
			return "空数据";
		}
	}
	
	//对Nonce的处理
	public function Nonce(){
		$this->Nonce = time()+rand(0,999);
	}
	
	//对CurTime的处理
	public function CurTime(){
		$this->CurTime = time();
	}
	
	//对CheckSum的处理
	public function CheckSum(){
		$this->Nonce();
		$this->CurTime();
		$this->CheckSum = sha1($this->AppSecret.$this->Nonce.$this->CurTime);
	}
	
	//发起请求
	public function CurlSend(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
		//准备工作
		$this->CheckSum();
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		//postheader
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json;charset=utf-8","AppKey:".$this->AppKey,"Nonce:".$this->Nonce,"CurTime:".$this->CurTime,"CheckSum:".$this->CheckSum));
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post_data);
		$output = curl_exec($ch);
		//错误提示
		$errno = curl_errno( $ch );
		$info  = curl_getinfo( $ch );
		//print_r($info);exit;
		curl_close($ch);
		//打印获得的数据
		$result = json_decode($output,true);
		return $result;
	}
}
/*
//查询频道列表
$post_data = json_encode(array ("records" => 10,"pnum" => 1,"ofield"=>"ctime","sort"=>0));
$curlpush = new Video("https://vcloud.163.com/app/channellist",$post_data);
$curlpush->CurlSend();
//修改频道
$post_data = json_encode(array ("name" => "测试直播间","cid"=>"7a44c3150034491eaaee6c603ced3c49","type"=>0));
$curlpush = new Video("https://vcloud.163.com/app/channel/update",$post_data);
$curlpush->CurlSend();
//删除频道
$post_data = json_encode(array ("cid"=>"7a44c3150034491eaaee6c603ced3c49"));
$curlpush = new Video("https://vcloud.163.com/app/channel/delete",$post_data);
$curlpush->CurlSend();
//获取频道状态
$post_data = json_encode(array ("name" => "测试直播间","cid"=>"7a44c3150034491eaaee6c603ced3c49"));
$curlpush = new Video("https://vcloud.163.com/app/channelstats",$post_data);
$curlpush->CurlSend();
//重新获取推流地址
$post_data = json_encode(array ("cid"=>"7a44c3150034491eaaee6c603ced3c49"));
$curlpush = new Video("https://vcloud.163.com/app/address",$post_data);
$curlpush->CurlSend();
*/