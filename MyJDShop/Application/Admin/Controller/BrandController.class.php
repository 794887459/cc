<?php
//商品品牌控制器
namespace Admin\Controller;
class BrandController extends BaseController{
	//添加品牌
	public function addBrand(){
		$typeDb = D('GoodsTypes');
		$brandDb = D("Brand");
		if ($_POST) {
			//处理图片
			$upload=new \Think\Upload();
			$upload->autoSub=false;
			$upload->mimes=array('image/png',"image/gif","image/jpeg");
			$upload->rootPath="./Public/";
			$upload->savePath="upload/";
			$imageArr=$upload->upload();
			if($imageArr){
				$_POST['imagename']=$imageArr['upload']['savename'];
			}
			if ($brandDb->create()){
				$re = $brandDb->add();
				if ($re) {
					$this->success('添加品牌成功','addBrand');exit;
				}else{
					$this->error('添加品牌失败','addBrand');exit;
				}				
			}else{
				//解决数据创建失败图片上传成功的问题
				if($imageArr){
					unlink('./Public/upload/'.$imageArr['upload']['savename']);
				}
				$info = $brandDb->getError();
				$this->assign('info',$info);
			}
		}
		//传分类下拉列表		
		$optinStr = $typeDb -> showType();
		$this->assign('optionStr',$optinStr);
		$this->display();
	}
	//品牌列表
	public function listBrand(){		//?????  $search_type
		$brandDb = D('Brand');
		$typeDb = D('GoodsTypes');
		//传品牌
		$search_type=$_GET["search_type"];//搜索的分类id
		$search_name=$_GET['search_name']==''?'%%':$_GET['search_name'];//搜索的品牌名
		//$search_name='%'.$_GET["search_name"].'%';
		if (!$search_type=='') {
			$brandArr = $brandDb->alias('b')
							->join('goodstypes as t on t.typeid=b.typeid')
							->field('b.*,t.typename')
							->where("b.typeid={$search_type} and brandname like '{$search_name}'")
							->order('b.typeid desc')->select();
			//echo $brandDb->_sql();exit;
		}else{
			$brandArr = $brandDb->alias('b')
							->join('goodstypes as t on t.typeid=b.typeid')
							->field('b.*,t.typename')
							->where("brandname like '{$search_name}'")
							->order('typeid desc')->select();
		}
		$this->assign('brandArr',$brandArr);
		//传分类
		$option = $typeDb->showType($search_type);
		$this->assign('option',$option);
		$this->display();
	}
	//回收品牌
	public function huishouBrand(){
		$brandDb = D('Brand');
		foreach ($_POST['id'] as $v){
			$brandDb->where("brandid={$v}")->save(array('isdel'=>0));
		}
		$path = $_SERVER['HTTP_REFERER'];
		header("location:{$path}");
		//$this->redirect('Admin/Brand/listBrand');
	}
	//显示品牌
	public function showBrand(){
		$brandDb = D('Brand');
		foreach ($_POST['id'] as $v){
			$brandDb->where("brandid={$v}")->save(array('isdel'=>1));
		}
		$path = $_SERVER['HTTP_REFERER'];
		header("location:{$path}");
	}
	//删除品牌
	public function deleteBrand(){
		//删除图片（根据id查询到图片地址然后删除）
		$brandDb = D('Brand');
		foreach ($_POST['id'] as $v){
			$imagepath = $brandDb->field('imagename')->where('brandid='.$v)->find();
			if($imagepath['imagename']!='no.png'){
				unlink('./Public/upload/'.$imagepath['imagename']);
			}			
			$brandDb->where("brandid={$v}")->delete();
		}
		$path = $_SERVER['HTTP_REFERER'];
		header("location:{$path}");
	}
	//修改品牌
	public function updateBrand(){
		$typeDb = D('GoodsTypes');
		$brandDb = D('Brand');
		$brandid = $_GET['brandid'];
		if ($_POST) {
			//处理图片（）
			$upload=new \Think\Upload();
			$upload->autoSub=false;
			$upload->mimes=array('image/png',"image/gif","image/jpeg");
			$upload->rootPath="./Public/";
			$upload->savePath="Upload/";
			$imageArr=$upload->upload();
			if($imageArr){
				//删除原来图片
				if($_POST['yuanimage']!='no.png'){
					unlink('./Public/upload/'.$_POST['yuanimage']);
				}				
				$_POST['imagename']=$imageArr['upload']['savename'];
			}
			//处理数据
			$brandDb->data($_POST)->where("brandid=$brandid")->save();
			$this->redirect('Admin/Brand/listBrand');		
		}
		
		
		
		
		//传此品牌信息
		$brandArr = $brandDb->where("brandid=$brandid")->find();
		$this->assign('brandArr',$brandArr);
		//传顶级分类
		$optionStr = $typeDb->showType($brandArr['typeid']);
		$this->assign('optionStr',$optionStr);
		$this->display();
	}
}
















