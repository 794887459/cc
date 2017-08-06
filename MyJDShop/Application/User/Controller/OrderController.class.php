<?php
//订单控制器
namespace User\Controller;
class OrderController extends MainController{
	//保存订单信息、订单明细
	public function order(){
		//开启事务
		M()->execute("start transaction");

		$userinfoDb  	= D('Userinfo');
		$orderinfoDb 	= D('Orderinfo');
		$cartDb			= D('Cart');
		$orderDetailsDb	= D('Orderdetails');
		//1.写orderinfo订单信息表
		$cartArr = $cartDb->select();
		$userInfoArr = $userinfoDb->where("userid={$_COOKIE['userid']} and state=1")->find();
		$orderNum = time().rand(0,9).rand(0,9).rand(0,9);//订单编号
		$totalPrice = $cartArr[0]['sum'];					 //订单总额
		$userInfoArr['orderNum']=$orderNum;
		$userInfoArr['totalPrice']=$totalPrice;
		unset($userInfoArr['id']);
		$re1 = $orderinfoDb->data($userInfoArr)->add();
		
		//2.写orderdetail订单详细表
		$state = true;//表明orderdetails表添加记录是否出错
		foreach ($cartArr as $k=>$v){
			$v['orderid']=$re1;
			$re2 = $orderDetailsDb->data($v)->add();
		if($re2 <= 0){
				//向orderdetails表添加记录，出错
				$state = false;
			}
		}
		//3.清空购物车
		$re3 = $cartDb->where("userid={$_COOKIE['userid']}")->delete();
		if ($re1 && $re3 && $state) {
			//提交事务
			M()->execute("commit");
			$this->display();
		}else{
			//回滚
			M()->execute("rollback");
			$this->error('订单失败',__APP__.'/Home/CartCookie/checkoutCart',100);
		}
	}
	//订单首页
	public function index(){
		$orderDb = D('Orderinfo');
		$detailDb = D('orderdetails');
		$pimageDb = D('Productimage');		
		
		//传订单详细
		$orderStr = getOrderStr();
		
		
		//传待付款
		$ispayNum = $orderDb->where("userid={$_COOKIE['userid']} and ispay=0")->count();
		
		$this->assign('orderStr',$orderStr);	//传订单详细信息
		$this->assign('ispayNum',$ispayNum);	//传待付款
		$this->display();
	}
	
	//删除订单(以及订单下所有商品)
	public function deleteOrder(){
		//开启事物
		M()->execute("start transaction");
		$orderDb = D('Orderinfo');
		$detailDb= D('orderdetails');
		
		//1.删除该订单
		$re1 = $orderDb->where("id={$_GET['orderid']}")->delete();
		//2.删除订单下商品
		$re2 = $detailDb->where("orderid={$_GET['orderid']}")->delete();
		if ($re1 && $re2) {
			//事务提交
			M()->execute("commit");
			$this->redirect('Order/index');
		}else{
			//事物回滚
			M()->execute("rollback");
			$this->error('异常错误',U('Order/index'));
		}
	}
	
	//查看订单
	public function orderDetail(){
		$orderDb = D('Orderinfo');
		$detailDb= D('orderdetails');
		$pimageDb= D('productimage');
		$uinfoDb = D('userinfo');
		
		//传此订单信息
		$orderArr = $orderDb->where("id={$_GET['orderid']}")->find();
		$timeArr = explode(' ', $orderArr['dataandtime']);
		$orderArr['date'] = $timeArr[0];
		$orderArr['time'] = $timeArr[1];
		//传订单详细信息(产品图片)
		$detailArr = $detailDb	->alias('d')
								->field('d.*,p.productname,p.vipprice')
								->join('product as p on p.productid=d.productid')
								->where("d.orderid={$_GET['orderid']}")->select();
		foreach ($detailArr as $k=>$v){
			$productid = $v['productid'];
			$pimageArr = $pimageDb->where("productid={$productid}")->find();
			$detailArr[$k]['imagename']=$pimageArr['imagename'];
		}
		//传收货人信息
		$addrArr = $uinfoDb->where("userid={$_COOKIE['userid']} and state=1")->find();
		if (mb_strlen($addrArr['addr'],'utf-8')>14) {
			$newAddr = insertToStr($addrArr['addr'], 14, '<br/>');
			$addrArr['addr']=$newAddr;
		}
		
		$this->assign('orderArr',$orderArr);	//传此订单信息
		$this->assign('detailArr',$detailArr);	//传订单详细信息(产品图片)
		$this->assign('addrArr',$addrArr);		//传收货人信息
		$this->assign('tomorrow',date('Y-m-d',strtotime('+1day')));//传送货日期
		$this->display();
	}
}

















