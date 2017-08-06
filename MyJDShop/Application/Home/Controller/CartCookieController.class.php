<?php
//购物车控制器
namespace Home\Controller;
class CartCookieController extends HomeController{
	//购物车主页
	public function index(){
		$productDb = D('Product');
		$productimageDb = D('Productimage');
		$cartDb = D('Cart');
		//用户已登录显示数据库商品
		if (isset($_COOKIE['userid'])) {
			$cartArr = $cartDb	->alias('c')
								->join('product as p on p.productid=c.productid')
								->field('c.*,p.productid,p.productname,p.vipprice')
								->where('userid='.$_COOKIE['userid'])
								->select();
			//把图片和总计放进数组
			foreach ($cartArr as $k=>$v){
				$productid = $v['productid'];
				$imageArr = $productimageDb->where("Productid=$productid")->find();
				$sum +=$v['xiaoji'];
				$cartArr[$k]['imagename'] = $imageArr['imagename'];
				$cartArr[$k]['sum'] = $sum;
			}
		}else{
			//用户未登录通过cookie里的商品id显示列表
			$arr = unserialize($_COOKIE['cart']);
			foreach ($arr as $v){
				$cartArr[] = $productDb->field('productid,productname,vipprice')->where("productid={$v['productid']}")->find();
			}
			foreach ($cartArr as $k=>$v){
				$productid = $v['productid'];
				$imageArr = $productimageDb->where("Productid=$productid")->find();
				$xiaoji = $v['vipprice']*$arr[$k]['num'];
				$sum +=$xiaoji; 
				$cartArr[$k]['num']=$arr[$k]['num'];
				$cartArr[$k]['xiaoji']=$xiaoji;
				$cartArr[$k]['imagename']=$imageArr['imagename'];
			}
			//print_r($cartArr);
		}
		
		$this->assign('cartArr',$cartArr);
		$this->assign('sum',$sum);
		$this->display();
	}
	//添加商品到购物车cookie
	public function addCart(){
		//已经登录保存到数据库
		if (isset($_COOKIE['userid'])) {
			$cartDb = D('Cart');
			$reArr = $cartDb->where("productid={$_POST['productid']}")->find();
			if ($reArr) {   //如果此产品已经在购物车则把数量叠加
				$re = $cartDb->where("productid={$_POST['productid']}")->save(array('num'=>$reArr['num']+$_POST['num']));
				$num = $reArr['num']+$_POST['num'];  //数据库里的+新加的
				$cartDb->where("productid={$_POST['productid']}")->save(array('xiaoji'=>$num*$_POST['vipprice']));
			}else{
				$_POST['userid']=$_COOKIE['userid'];
				$_POST['xiaoji']=$_POST['vipprice']*$_POST['num'];
				$re = $cartDb->data($_POST)->add();
			}
			if ($re) {
				//print_r($_POST);exit;
				$this->redirect("CartCookie/index");exit;
			}	
		}
		//如果用户未登录则保存到cookie
		if (isset($_COOKIE['cart'])) {
			$arr = unserialize($_COOKIE['cart']);
			$a=true;
			foreach ($arr as $k=>$v){
				if($v['productid']==$_POST['productid']){
					$arr[$k]['num'] += $_POST['num'];
					$a=false;
				}
			}
			if ($a) {
				$arr[] = $_POST;
			}
		}else{
			$arr[] = $_POST;
		}
		setcookie('cart',serialize($arr),time()+365*24*3600,'/');
		$this->redirect("CartCookie/index");
	}
	//删除购物车商品
	public function deleteCart(){
		//如果用户已登录
		if (isset($_COOKIE['userid'])) {
			$cartDb = D('Cart');
			$cartDb->where("productid={$_GET['productid']}")->delete();
		}else{
			$arr = unserialize($_COOKIE['cart']);
			foreach ($arr as $k=>$v){
				if ($v['productid']==$_GET['productid']) {
					unset($arr[$k]);
				}
			}
			setcookie('cart',serialize($arr),time()+365*24*3600,'/');
		}
		$this->redirect("CartCookie/index");
	}	
	//更新购物车
	public function updateCart(){
		//如果用户已登录(更新数据库数量和小计)
		if (isset($_COOKIE['userid'])) {
			$cartDb = D('Cart');
			foreach ($_POST['amount'] as $k=>$v){
				$cartDb->where("productid={$_POST['productid'][$k]}")->save(array('num'=>$v));
				$xiaoji=$_POST['amount'][$k]*$_POST['vipprice'][$k];
				$cartDb->where("productid={$_POST['productid'][$k]}")->save(array('xiaoji'=>$xiaoji));
			}
		}else{
			$upArr = $_POST['amount'];
			$arr = unserialize($_COOKIE['cart']); 
			foreach ($arr as $k=>$v){
				$arr[$k]['num']=$upArr[$k];
			}
			setcookie('cart',serialize($arr),time()+365*24*3600,'/');
		}
		
		$this->redirect("CartCookie/index");
	}
	//购物车结算
	public function checkoutCart(){
		if (!isset($_COOKIE['userid'])) {
			$this->redirect('Home/User/login/s/1');exit;	
		}
		$cartDb = D('Cart');
		$pimageDb = D('Productimage');
		$userinfoDb = D('Userinfo');
		if (isset($_POST['sum'])) {
			$cartDb->where('userid='.$_COOKIE['userid'])->save(array('sum'=>$_POST['sum']));
		}
		//显示购物车产品
		$cartArr = $cartDb	->alias('c')
							->join('product as p on p.productid=c.productid')
							->field('c.*,p.vipprice,p.productname')
							->select();
		foreach ($cartArr as $k=>$v){
			$productid = $v['productid'];
			$imageArr = $pimageDb->where("productid={$productid}")->find();
			$cartArr[$k]['imagename']=$imageArr['imagename'];
		}
		//显示收货人信息
		$defArr = $userinfoDb->where("userid={$_COOKIE['userid']} and state=1")->find();
		$infoArr = $userinfoDb->where("userid={$_COOKIE['userid']}")->select();
		if (empty($infoArr)) {
			$this->redirect('User/User/addAddr');exit;
		}
		//传省份
		$this->assign('cityStr',cityOption());
		$this->assign('cartArr',$cartArr);
		$this->assign('defArr',$defArr);
		$this->assign('infoArr',$infoArr);
		$this->display();
	}
	

}





























