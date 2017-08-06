<?php
//产品控制器
namespace Admin\Controller;
class ProductController extends BaseController{
	//添加产品
	public function addProduct(){
		$typeDb = D('GoodsTypes');
		$brandDb = D('Brand');
		$productDb = D('Product');
		$productimage = M('productimage');
		if ($_POST) {
			//创建数据如果成功则添加产品信息到表  如果成功则处理图片并把图片添加到表 
			if ($productDb->create()) {
				$addId = $productDb->add();
				if ($addId) {
					//得到id处理图片并添加到表
					$upload=new \Think\Upload();
					$upload->autoSub=false;
					$upload->mimes=array('image/png',"image/gif","image/jpeg");
					$upload->rootPath="./Public/";
					$upload->savePath="upload/product/";
					$imageArr=$upload->upload();
					if ($imageArr) {
						foreach ($imageArr as $v){ 
							$productimage->data(array('productid'=>$addId,'imagename'=>$v['savename']))->add();
						}
					}
					$this->success('添加成功',U('Admin/Product/listProduct'));exit;
				}else{
					//产品信息写表失败
					$this->error('添加产品失败',U('Admin/Product/addProduct'));exit;
				}
			}else{
				//创建失败返回错误信息
				$info = $productDb->getError();
				$this->assign('post',$_POST);
				$this->assign('info',$info);
			}
		}
		//传分类(option)
		$optionStr = $typeDb->showOptionBystr();
		$this->assign('optionStr',$optionStr);
		//传品牌(option)
		$brandtArr = $brandDb->select();
		$this->assign('brandArr',$brandtArr);
		$this->display();
	} 
	//产品列表
	public function listProduct(){
		$productDb = D('Product');
		$typeDb = D('GoodsTypes');
		$brandDb = D('Brand');
		$productimageDb = D('Productimage');
		
		//传产品信息
		$search_typestr = '%'.htmlspecialchars($_GET['search_typestr']).'%';//搜索的分类字符串
		$search_brandid = $_GET['search_brandid'];							//搜索的品牌id
		$search_name    = '%'.htmlspecialchars($_GET['search_name']).'%';	//搜索的商品名
		//echo $search_typestr.'<br/>';
		
		//分页
		if ($search_brandid=='') {
			$totalRows = $productDb->where("typestr like '{$search_typestr}' and productname like '{$search_name}'")->count();
		}else{
			$totalRows = $productDb->where("typestr like '{$search_typestr}' and brandid={$search_brandid} and productname like '{$search_name}'")
									->count();	
		}
		$pageSzie = 2;
		$pageDb = new \Think\Page($totalRows,$pageSzie);
		$offset = $pageDb->firstRow;
		$pagestr = $pageDb->show();
		//传当前页数据
		if ($search_brandid=='') {
			$productArr = $productDb->field('p.*,b.brandname')
									->alias('p')->join('brand as b on b.brandid=p.brandid')
									->where("p.typestr like '{$search_typestr}' and p.productname like '{$search_name}'")
									->limit($offset,$pageSzie)
									->order('productid desc')
									->select();
		}else{
			$productArr = $productDb->field('p.*,b.brandname')
									->alias('p')->join('brand as b on b.brandid=p.brandid')
									->where("p.typestr like '{$search_typestr}' and p.brandid={$search_brandid} and p.productname like '{$search_name}'")
									->limit($offset,$pageSzie)
									->order('productid desc')
									->select();
		}
		
		//传图片   传分类字符串
		$typeArr=array();
		foreach ($productArr as $k=>$v){
			$productid = $v['productid'];//得到商品id 查商品图片
			$typestr= $v['typestr'];//得到typestr,处理字符串，并拼接字符串
			$str = getTypeStr($typestr);
			$productArr[$k]['typestr']=$str;
			$imageArr = $productimageDb->where('productid='.$productid)->find();
			$productArr[$k]['imagename']=$imageArr['imagename'];
		}
		
		$this->assign('productArr',$productArr);
		$this->assign('pagestr',$pagestr);

		//传分类(option)
		//处理typeid(%>1>2>%)  去除两端的%(>1>2>)  转为数组并将最后一个空值出栈，得到id
		$newStr = trim($search_typestr,'%');
		$typeArr = explode('&gt;', $newStr);
		array_pop($typeArr);
		$typeid = end($typeArr);

		
		$typeOption = $typeDb->showOptionBystr(0,0,$typeid,'');
		$this->assign('typeOption',$typeOption);
		//传品牌(option)
		$brandtArr = $brandDb->select();
		$this->assign('brandid',$search_brandid);
		$this->assign('brandArr',$brandtArr);
		$this->assign('searchname',$_GET['search_name']);
		$this->assign('pagestr',$pagestr);//传分页
		$this->display();
	}
	
	//ajax返回相应品牌信息
	public function ajax(){
		//echo $_GET['typeid'];//>1>2>3
		//处理数据  根据typeid查询品牌并返回数据
		$brandDb = D('Brand');
		$arr = explode('>', $_GET['typeid']);
		$option='';
		$typeid=$arr[1];
		$brandid=$_GET['brandid'];
		$brandArr = $brandDb->where('typeid='.$typeid)->select();
		foreach ($brandArr as $v){
			if ($v['brandid']==$brandid) {
				$option.="<option value={$v['brandid']} selected='selected'>{$v['brandname']}</option>";
			}else{
				$option.="<option value={$v['brandid']}>{$v['brandname']}</option>";
			}			
		}
		//alert($_GET['brandid']);
		echo $option;
	}
	//修改商品信息
	public function updateProduct(){
		$typeDb = D('GoodsTypes');
		$brandDb = D('Brand');
		$productDb = D('Product');
		$productimageDb = D('Productimage');
		if ($_POST) {
			//创建数据如果成功则添加产品信息到表  如果成功则处理图片并把图片添加到表
			if ($productDb->create()) {
				$addId = $productDb->where("productid={$_GET['productid']}")->save();
				if ($addId) {
					$this->success('修改成功',U('Admin/Product/listProduct'));exit;
				}else{
					//产品信息写表失败
					$this->error('修改产品失败',U('Admin/Product/updateProduct'));exit;
				}
			}else{
				//创建失败返回错误信息
				$info = $productDb->getError();
				$this->assign('info',$info);
			}
		}
		
		//传修改页数据  接收productid
		$productid = $_GET['productid'];
		$productArr = $productDb->where("productid={$productid}")->find();
		//传图片
		$productid = $productArr['productid'];
		$arr = $productimageDb->where("imageid={$productid}")->find(); 
		$productArr['imagename'] = $arr['imagename'];
		//传分类(option)
		$optionStr = $typeDb->showOptionBystr(0,0,$productArr['typestr'],'');
		$this->assign('optionStr',$optionStr);
		//传品牌(option)
		$brandtArr = $brandDb->select();
		$this->assign('brandArr',$brandtArr);
		$this->assign('productArr',$productArr);
		$this->display();
	}
	//修改图片
	public function updateImage(){
		$productid = $_GET['productid'];
		$productDb = D('Product');
		$productimageDb = D('Productimage');
		$arr = $productDb->where("productid={$productid}")->field('productname')->find();//获取名称
		$imageArr = $productimageDb->where("productid={$productid}")->select();
		$this->assign('arr',$arr);
		$this->assign('imageArr',$imageArr);
		$this->display();
	}
	//回收商品
	public function huishouProduct(){
		$productDb = D('Product');
		foreach ($_POST['id'] as $v){
			$productDb->where("productid={$v}")->save(array('isdel'=>0));
		}
		$this->redirect('Admin/Product/listProduct');
	}
	//显示商品
	public function showProduct(){
		$productDb = D('Product');
		foreach ($_POST['id'] as $v){
			$productDb->where("productid={$v}")->save(array('isdel'=>1));
		}
		$this->redirect('Admin/Product/listProduct');
	}
	//删除商品
	public function deleteProduct(){
		$productDb = D('Product');
		$productimageDb = D('Productimage');
		foreach ($_POST['id'] as $v){
			//删除图片(先得到图片名然后删除图片、记录)
			$imageArr = $productimageDb->where("productid={$v}")->select();
			print_r($imageArr);
			foreach ($imageArr as $iv){
				unlink("E:\PHP\www\MyJDShop\Public\upload\product/{$iv['imagename']}");
			}
			
			$productimageDb->where("productid={$v}")->delete();
			$productDb->where("productid={$v}")->delete();
		}
		
		$this->redirect('Admin/Product/listProduct');
	}
}










































 


