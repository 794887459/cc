<?php
namespace Home\Controller;
use \Think\Controller;
class HomeController extends Controller{	
	
	//构造方法	传头部导航分类
	public function _initialize(){
		$headerControllerName=CONTROLLER_NAME;//当前控制器名字
		$this->assign('headerControllerName',$headerControllerName);
		$typeDb = D('goodstypes');
		$headerFatherTypeArr = $typeDb -> where('fid=0 and isdel=1')->select();
		$allTypeStr = getAllTypeToStr();
		 
		
		//传一级分类的id，get  tstr
		if(is_numeric($_GET['typeid'])){  //如果是数字
			$this->assign('headerTypeId',$_GET['typeid']);
		}else if(!is_numeric($_GET['typeid'])){
			$aaaa = explode('>',trim($_GET['typeid'],'>'))[0];
			//preg_match('/^>(\d+)/',$_GET['typeid'],$typeidArr);
			$this->assign('headerTypeId',$aaaa);
		}
		//传最近浏览(用户登录后传最近浏览)
		$clickDb = D('click');
		$pimageDb = D('productimage');
		$productDb = D('product');
		$where = isset($_COOKIE['userid']) ? "userid={$_COOKIE['userid']}" : "userid=1";
		$clickArr = $clickDb->where("$where")->group('productid')->order('clickid desc')->limit(5)->select();
		//echo $clickDb->_sql();
		foreach ($clickArr as $k=>$v){
			$productid = $v['productid'];
			$imgArr = $pimageDb->where("productid={$productid}")->find();
			$productArr = $productDb->where("productid={$productid}")->field('productname')->find();
			$clickArr[$k]['imagename'] = $imgArr['imagename'];
			$clickArr[$k]['productname'] = $productArr['productname'];
		}
		//传新品推荐
		$newsProduct = $productDb->where("state=2")->select();
		foreach ($newsProduct as $k=>$v){
			$productid = $v['productid'];
			$pimgArr = $pimageDb->where("productid={$productid}")->find();
			$newsProduct[$k]['imagename']=$pimgArr['imagename'];
		}		
		//传热门搜索(根据这个商品的点击数抽取四个商品名称)
		$productDb = D('Product');
		$clickTop = $productDb->field('productid,productname')->limit(0,3)->order('clicknum desc')->select();
		//传购物车数量
		$cartDb = D('cart');
		$cartWhere = isset($_COOKIE['userid']) ? "userid={$_COOKIE['userid']}" : "userid=1";
		$cartNum = $cartDb->where("$cartWhere")->count();
		$this->assign('cartNum',$cartNum);							//传购物车数量
		$this->assign('clickTop',$clickTop);						//传热门点击
		$this->assign('allTypeStr',$allTypeStr);					//传所有商品分类
		$this->assign('headerFatherTypeArr',$headerFatherTypeArr);	//传头部导航
		$this->assign('clickArr',$clickArr);						//传最近浏览
		$this->assign('newProduct',$newsProduct);					//传新品推荐
	}	
}






















