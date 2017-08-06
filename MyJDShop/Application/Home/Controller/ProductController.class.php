<?php
//商品分类控制器
namespace Home\Controller;
class ProductController extends HomeController{
	//传商品列表(根据typeid传商品)
	public function productList(){
		$productDb = D('Product');
		$productImageDb = D('Productimage');
		$brandDb = D('Brand');
		$typeDb  = D('Goodstypes');
		$typeid = $_GET['typeid'];
		//传此分类下的商品信息  分页 
		if (preg_match("/^>/",$typeid)) {  //3   >1>2
			$typeid=htmlspecialchars($typeid);
			$total = $productDb->where("typestr like '{$typeid}%'")->count();
		}else{
			$total = $productDb->where("typestr like '&gt;{$typeid}&gt;%'")->count();//获取此分类下的总条数
		}		
		
		$pageSzie = 4;															//指定每页显示条数
		$pageDb = new \Think\Page($total,$pageSzie);							//实例化分页类
		$offset = $pageDb->firstRow;											//开始位置
												
		//排序										
		$fieldInfo = $_GET['field'];//接收字段信息(salesnum price 或者null)
		$ordertype = $_GET['order'];//接收排序方式(asc  desc)
		$order = $fieldInfo ? $fieldInfo." $ordertype" : 'salesnum desc';
		
		//筛选
		$brandid = $_GET['brandid'];//接收品牌id  (1 2 3)
		$whereStr = $brandid ? "brandid=$brandid and" : '';
		
					
		//根据typeid   传产品信息(传图品 传分页)		
		if (!is_numeric($typeid)) {			
			$arr = $productDb->where("$whereStr typestr like '{$typeid}%'")
							 ->order($order)
							 ->limit($offset,$pageSzie)
							 ->select();
		}else{
			$arr = $productDb->where("$whereStr typestr like '&gt;{$typeid}&gt;%'")
							 ->order($order)
							 ->limit($offset,$pageSzie)
							 ->select();
		}
		//var_dump($arr);
		//echo $productDb->_sql().'<br/>';
		foreach ($arr as $k=>$v){
			$productid = $v['productid'];
			$productimageArr = $productImageDb->where('productid='.$productid)->find();
			$arr[$k]['imagename'] = $productimageArr['imagename'];
		}
		
		//传热卖商品列表(提取state=1的为热卖商品)
		$hotarr = $productDb -> where('state=1 and isdel=1')->limit(0,3)->select();
		foreach ($hotarr as $k=>$v){
			$productid = $v['productid'];
			$imageArr = $productImageDb->where("productid=$productid")->find();
			$hotarr[$k]['imagename'] = $imageArr['imagename'];
		}
		
		
		
		//传品牌(根据typeid传品牌)
		if (!is_numeric($typeid)) {
			$typeid = explode('&gt;',trim($typeid,'&gt;'))[0];
		}
		$brandArr = $brandDb->where("typeid=$typeid and isdel=1")->select();
		
		//传面包屑
		//$nameArr = $typeDb->where("typeid={$typeid}")->find();
		$nameStr = showCrumbs($_GET['typeid']);
		//传列表页菜单
		$catList = showCatList();
		$this->assign('catList',$catList);					//传列表页菜单
		$this->assign('nameStr',$nameStr);					//传面包屑
		$this->assign('brandArr',$brandArr);				//传品牌
		$this->assign('hotProduct',$hotarr);				//传热卖
		$this->assign('productArr',$arr);  					//传产品信息
		$this->assign('pagestr',$pageDb->show());			//传分页
		$this->assign('countpage',ceil($total/$pageSzie));	//传总页数
		$this->display();
	}
	
	//全局搜索页
	public function productSearch(){
		$keyword = $_GET['search'];//搜索的关键字
		if(!preg_match('/^\S+/', $_GET['search'])){
			$this->redirect('Index/index');
		}else{
			include_once 'Sphinx/sphinxapi.php';
			$productDb = D('Product');
			$productImageDb = D('Productimage');
			$brandDb = D('Brand');
			$typeDb  = D('Goodstypes');
			
			//实例化sphinx并设置
			$scDb = new \SphinxClient();
			$scDb->SetServer("localhost",9312);	//设置coreseek的主机名和端口
			$scDb->SetArrayResult(true);		//设置返回结果集为php数组格式
			$scDb->SetLimits(0, 20,1000);		//匹配结果的偏移量，参数的意义依次为：起始位置，返回结果条数，最大匹配条数
			$scDb->SetMaxQueryTime(10);			//最大搜索时间
			$scDb->SetMatchMode(SPH_MATCH_ANY);	//设置切词方式
			/*
			* Sphinx的三种切词方式：
			* SPH_MATCH_ALL：切词，所有词必须全部匹配
			* SPH_MATCH_ANY：切词，只需任意一个词匹配
			* SPH_MATCH_PHRASE：不切词
			*/
			/*
			* $sc->Query()参数说明：
			* 第一个参数：搜索关键字
			* 第二个参数：指定的是索引名(配置文件中指定的索引名)
			*/
			$re = $scDb->Query($keyword,'*');
			$str = '';
			
			if(isset($re["matches"])){
				//print_r($re["matches"]);
				foreach ($re['matches'] as $v){
					$str .= ','.$v['id'];
				}
				$str = ltrim($str,',');
				//传品牌(根据权重高的styleid查询品牌)
				$subid = substr($str, 0,1);
				$pArr = $productDb->where('productid='.$subid)->find();
				$typestr = str_replace('&gt;', '>', $pArr['typestr']);
				$typeid = substr($typestr,1,1);
				$brandArr = $brandDb->where('typeid='.$typeid)->select();
				//传商品 、分页
				$total = $productDb->where("productid in({$str})")->count();
				$pageSize = 4;
				$pageDb = new \Think\Page($total,$pageSize);
				$offset = $pageDb->firstRow;
				$pagestr = $pageDb->show();
				
				//筛选
				$brandid = $_GET['brandid'];//接收品牌id  (1 2 3)
				$whereStr = $brandid ? "brandid=$brandid and" : '';
				
				$productArr = $productDb->where("{$whereStr} productid in({$str})")->limit($offset,$pageSize)->select();
				foreach ($productArr as $k=>$v){
					$productname = str_replace($keyword, "<font color='red'>{$keyword}</font>", $v['productname']);
					$productArr[$k]['productname'] = $productname;
				}
				foreach ($productArr as $k=>$v){
					$productid = $v['productid'];
					$imageArr = $productImageDb->where("productid=$productid")->find();
					$productArr[$k]['imagename'] = $imageArr['imagename'];
				}
			}else{
				$this->display('Public/no');exit;
			}
			
			
			//传热卖商品列表(提取state=1的为热卖商品)
			$hotarr = $productDb -> where('state=1 and isdel=1')->limit(0,3)->select();
			foreach ($hotarr as $k=>$v){
				$productid = $v['productid'];
				$imageArr = $productImageDb->where("productid=$productid")->find();
				$hotarr[$k]['imagename'] = $imageArr['imagename'];
			}
			//传列表页菜单
			$catList = showCatList();
			$this->assign('catList',$catList);					//传列表页菜单
			$this->assign('productArr',$productArr);			//传商品
			$this->assign('pagestr',$pagestr);					//传分页
			$this->assign('countpage',ceil($total/$pageSize));	//传总页数
			$this->assign('brandArr',$brandArr);				//传品牌
			$this->assign('hotProduct',$hotarr);				//传热卖
			$this->assign('typeid',$typeid);					//传热卖
			$this->display();
		}
		
	}
	
		
	//商品详细页
	public function productDetail(){
		$productDb = D('Product');
		$productimageDb = D('Productimage');
		$clickDb = D('click');
		$productid = $_GET['productid'];
		//product表点击数加1   、  click表添加记录
		if($productid!=0){
			$clickWhere = isset($_COOKIE['userid']) ? "{$_COOKIE['userid']}" : "1";
			$re = $clickDb->data(array("productid"=>$productid,'userid'=>$clickWhere,'clicktime'=>date('Y-m-d',time())))->add();
			//echo $clickDb->_sql();
			if ($re) {
				$sql = "update product set clicknum=clicknum+1 where productid={$productid}";
				$productDb->execute($sql);
			}
		}
		//传商品信息
		$productArr = $productDb->where("productid=$productid")->find();
		$productArr['style']=htmlspecialchars_decode($productArr['style']);
		$productArr['content']=htmlspecialchars_decode($productArr['content']);
	
		$imageArr = $productimageDb->where("productid=$productid")->select();
		//传面包屑
		$typestr = $productArr['typestr'];		
		$nameStr = showCrumbs($typestr);
		
		
		$this->assign('productArr',$productArr);//商品信息  >1>2>7>  >1>2>3>
		$this->assign('imageArr',$imageArr);
		$this->assign('nameStr',$nameStr);//面包屑
		$this->display();
	}

}






























