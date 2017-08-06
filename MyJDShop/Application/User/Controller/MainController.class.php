<?php
//用户控制基类
namespace User\Controller;
use \Think\Controller;
class MainController extends Controller{
	//构造方法	传头部导航分类
	public function _initialize(){
		if (!isset($_COOKIE['userid'])) {
			$this->error('请登录',U('Home/User/login'),1);
		}
		
		$headerControllerName=CONTROLLER_NAME;
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
		
		//传热门搜索(根据这个商品的点击数抽取四个商品名称)
		$productDb = D('Product');
		$clickTop = $productDb->field('productid,productname')->limit(0,3)->order('clicknum desc')->select();
		$this->assign('clickTop',$clickTop);						//传热门点击
		$this->assign('allTypeStr',$allTypeStr);					//传所有商品分类
		$this->assign('headerFatherTypeArr',$headerFatherTypeArr);	//传头部导航
		$this->assign('controller',CONTROLLER_NAME);				//传方法名
		$this->assign('method',ACTION_NAME);						//传方法名
	}
}