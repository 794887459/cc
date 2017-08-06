<?php
//后台登录控制器
namespace Admin\Controller;
use \Think\Controller;
class LoginController extends Controller{
	//登录主页
	public function login(){
		if ($_POST) {
			//用自动验证和自动完成
			$Db = D('Admin');
			$cRe = $Db -> create($_POST,4);
			$password = md5($_POST['password']);
			if ($cRe) {
				$re = $Db -> where("username='{$_POST['username']}' and password='{$password}'")->find();
				if ($re) {
					//创建会话变量   登陆次数加1
					setcookie('aid',$re['aid'],0,'/');
					setcookie('username',$re['username'],0,'/');
					setcookie('aname',$re['aname'],0,'/');
					$sql = "update admin set loginnum=loginnum+1 where aid={$re['aid']}";
					$Db -> execute($sql);				
					$this->success('登录成功',U('Admin/Index/index'));exit;
				}else{
					$this->error('异常错误',U('Admin/Login/login'));
				}
			}else{
				$info = $Db -> getError();
				$this->assign('value',$_POST);
				$this->assign('info',$info);
			}
		}
		$this->display();			
	}
	//显示验证码
	public function showCode(){
		$code = new \Think\Verify();
		$code -> fontSize=12;
		$code -> length=4;
	 	$code -> entry();		
	}
	//用户退出
	public function logout(){
		setcookie('aid','',time()-1,'/');
		setcookie('aname','',time()-1,'/');
		$this->redirect('Admin/Login/login');
	}
}
























