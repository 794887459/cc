<?php
//用户信息控制器
namespace User\Controller;
class UserController extends MainController{
	//用户首页
	public function index(){
		$userDb = D('Users');
		//传会员信息
		$userArr = $userDb->where('userid='.$_COOKIE['userid'])->find();
		$this->assign('userArr',$userArr);
		$this->display();
	}
	//修改默认地址(将状态改为1,并将其他置为0)
	public function setDefaddr(){
		$infoDb = D('Userinfo');
		$infoDb->where("userid={$_COOKIE['userid']}")->save(array('state'=>0));
		$infoDb->where("id={$_GET['id']}")->save(array('state'=>1));
		$this->redirect("Home/CartCookie/checkoutCart");
	}
	//添加/修改收货地址
	public function addAddr(){
		$infoDb = D('Userinfo');
		$cityDb = D('City');
		$userinfoDb = M('Userinfo');
		if ($_POST) {
			$addr='';
			if (!empty($_POST['city'])) {
				$arr = $cityDb->where("cid={$_POST['city']} or cid={$_POST['region']} or cid={$_POST['county']}")->select();
				foreach ($arr as $v){
					$addr.=$v['cname'];
				}
			}
			if (isset($_POST['state'])) {
				$userinfoDb->where("userid={$_COOKIE['userid']}")->save(array('state'=>0));
			}
			$addr.=$_POST['addr'];
			$_POST['addr']=$addr;
			$_POST['userid']=$_COOKIE['userid'];
			if (isset($_GET['id'])) {
				$userinfoDb->where("id={$_GET['id']}")->data($_POST)->save();//修改
				if (isset($_GET['s']) && $_GET['s']==2) {
					$this->success('修改成功',U('Home/CartCookie/checkoutCart'));exit;
				}else{
					$this->success('修改成功',U('User/User/addAddr'));exit;
				}	
			}else{
				//print_r($_POST);exit;
				$userinfoDb->data($_POST)->add();//添加
				if (isset($_GET['s']) && $_GET['s']==2) {
					$this->redirect('Home/CartCookie/checkoutCart');exit;
				}
			}
		}
		
		if (isset($_GET["id"])) {
			$thisArr = $infoDb->where("id={$_GET['id']}")->find();
			$this->assign('thisArr',$thisArr);
		}
		//传会员地址
		$infoArr = $infoDb->where("userid={$_COOKIE['userid']}")->select();
		//传省份
		$this->assign('cityStr',cityOption());
		$this->assign('infoArr',$infoArr);
		$this->display();
	}
	
	
	//删除收货信息
	public function deleteAddr(){
		$userinfoDb = M('Userinfo');
		$userinfoDb->where("id={$_GET['id']}")->delete();
		if (isset($_GET['s']) && $_GET['s']==2) {
			$this->redirect('Home/CartCookie/checkoutCart');exit;
		}else {
			$this->redirect('User/User/addAddr');exit;
		}
	}
	//ajax
	public function ajax(){
		$cityDb = D('City');
		$cid = $_GET['cid'];
		$regionStr =regionOption($cid);
		echo $regionStr;
	}
	//用户详细信息
	public function userinfo(){
		$userDb = D('Users');
		if ($_POST) {
			print_r($_POST);
			$re = $userDb->where("userid={$_COOKIE['userid']}")->save($_POST);
			if ($re) {
				cookie('nickname',$_POST['nickname']);
				$this->success('修改成功',U('User/index'));exit;
			}
		}
		//传会员信息
		$userArr = $userDb->where('userid='.$_COOKIE['userid'])->find();
		$this->assign('userArr',$userArr);
		$this->display();
	}
	
	//更新用户送货信息
	public function updateAddr(){
		//print_r($_POST);exit;
		$userinfoDb = M('Userinfo');
		$userinfoDb->where("state=1 and userid={$_COOKIE['userid']}")->save($_POST);
		if (isset($_GET['s']) && $_GET['s']==2) {
			$this->redirect('Home/CartCookie/checkoutCart');exit;
		}else {
			$this->redirect('User/User/addAddr');exit;
		}
	}
	
}































