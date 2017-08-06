<?php
//后台主页控制器
namespace Admin\Controller;
class IndexController extends BaseController{
	//后台主页
	public function head(){
		$this->display();
	}
	public function index(){
		$this->display();
	}
	public function left(){
		$this->display();
	}
	public function right(){
		$db = D('Admin');
		$aid=$_COOKIE['aid'];
		$re = $db ->where('aid='.$aid)->find();
		$time = date('Y-M-d H:i:s',time());
		$this->assign('adminInfo',$re);
		$this->assign('time',$time);
		$this->display();
	}
}