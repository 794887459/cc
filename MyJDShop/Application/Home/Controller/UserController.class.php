<?php
//会员控制器
namespace Home\Controller;
class UserController extends HomeController{
	//用户登录界面
	public function login(){
		if ($_POST) {
			//print_r($_POST);exit;
			$code = new \Think\Verify();
			$userDb = D("Users");
			$time = isset($_POST['info']) ? time()+30*24*3600 : 0;//cookie保存时间
			$password = md5($_POST['password']);
			if (!$code->check($_POST['checkcode'])) {
				$this->assign('info','验证码错误');
				$this->assign('post',$_POST);
			}else{
				//判断用户名密码  保存cookie 跳转
				$re = $userDb->where("username='{$_POST['username']}' and password='{$password}'")->find();
				if ($re) {
					setcookie('userid',$re['userid'],$time,'/');
					setcookie('nickname',$re['nickname'],$time,'/');
					setcookie('username',$re['username'],$time,'/');
					//如果是从购物车页面跳转  则保存购物车商品信息 并跳转到购物车页面
					if (isset($_GET['s']) && $_GET['s']==1) {
						$cartDb = D('Cart');
						$arr = unserialize($_COOKIE['cart']);
						foreach ($arr as $k=>$v){
							$pidre = $cartDb->where("productid={$v['productid']}")->find(); //判断cookie购物车产品是否和数据库购物车产品冲突
							if ($pidre) {  //如果冲突则更新数据库(数量  小计)
								$u1 = $cartDb->where("productid={$v['productid']}")->save(array('num'=>$pidre['num']+$v['num']));
								$num=$pidre['num']+$v['num'];
								$u2 = $cartDb->where("productid={$v['productid']}")->save(array('xiaoji'=>$num*$v['vipprice']));
								if($u1 && $u2){
									setcookie('cart','',time()-1,'/');
									$addre=true;
								}
							}else{
								$v['userid']=$re['userid'];
								$v['xiaoji']=$v['num']*$v['vipprice'];
								$addre = $cartDb->data($v)->add();
							}
						}
						if ($addre) {  //如果添加cookie购物车产品成功
							$this->redirect("CartCookie/index");exit;
						}
					}
					if (isset($_GET['s']) && $_GET['s']==1) {
						$this->redirect("CartCookie/index");exit;
					}
					$this->redirect("Index/index");
				}else{
					$this->error('用户名或密码错误','login');
				}
			}
		}
		$this->display();
	}
	//用户注册
	public function regist(){
		if ($_POST) {
			//自动验证  自动完成  验证码比对
			//print_r($_POST);
			$code=new \Think\Verify();
			$userDb = D('Users');
			/* if (!$code->check($_POST['checkcode'])) {
				$this->error('验证码错误','regist',1);exit;
			} */
			if ($userDb->create()) {
				$userid = $userDb->add();
				$this->success('注册成功','login');exit;
			}else{
				//获取错误信息传模板
				$errinfo = $userDb->getError();
				$this->assign('errinfo',$errinfo);
				$this->assign('post',$_POST);
			}
		}
		$this->display();
	}
	//显示验证码
	public function showCode(){
		$code = new \Think\Verify();
		$code -> fontSize=15;
		$code -> length=4;
	 	$code -> entry();
	}
	//退出
	public function logout(){
		setcookie('userid','',time()-1,'/');
 		setcookie('nickname','',time()-1,'/');
 		$this->redirect('Index/index');
	}
}



























