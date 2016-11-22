<?php
namespace Admin\Controller;
use Common\ORG\Util\Page;
use Common\ORG\Util\Serverapi;
use Org\Util\ApiEasemobAction;

class HxgroupController extends BaseController {
    public function _initialize(){
        parent::_initialize();
        $this->talkgroup = D('Group_hx');
    }
    //首页列表，条件搜索
    public function index(){
        $where = "";
        $name = I('name');
        if($name){
            $where['market_name'] = array("like","%".$name."%");
        }
        $count = $this->talkgroup->where($where)->count();
        if($count == 0){
            $this->assign('not_found','没有您搜索的结果！');
        }
        $page = new Page($count,10);
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$res = $this->talkgroup->where($where)->order('id ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page', $page->show());
        $this->assign('list',$res);
        $this->assign('name',$name);
        $this->display();
    }
   /*
   public function info(){
   		$id = I('id');
   		$condition = array(
   			'id' => $id,
   		);
   		$result_info = $this->talkgroup->getone($condition);
   		if( !$result_info ){
   			
   		}else{
   			$ApiEasemobAction = new ApiEasemobAction();
   			$group_detail = $ApiEasemobAction->chatGroupsDetails($result_info['group_id']);
   			print_r($group_detail);exit;
   		}
   }
   */
}