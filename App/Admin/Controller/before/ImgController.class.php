<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
class ImgController extends BaseController {
    public $user;
    public function _initialize(){
       // parent::_initialize();
        //$this->user = D('user');
         
    }
    public function a(){
    	
    	$this->display();
    }
    public function create(){
    	//上传附件
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
    	$upload->savePath  =     ''; // 设置附件上传（子）目录
    	// 上传文件
    	$info=$upload->upload();
    	if($info){
     		$imgdata['file_path1']="Uploads/".$info['id_positive']['savepath'].$info['id_positive']['savename'];
   		 	$this->ajaxReturn($imgdata);
    	}
          
     }
    
    
     
    //首页列表，条件搜索
    public function index(){
    	
       $this->display();
       }
   }