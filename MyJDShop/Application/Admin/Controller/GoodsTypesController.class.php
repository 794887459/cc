<?php
//商品分类控制器
namespace Admin\Controller;
class GoodsTypesController extends BaseController{
	//添加商品分类
	public function addTypes(){
		$typeDb = D('GoodsTypes');
		if ($_POST) {
			if($typeDb->create()){
				$re = $typeDb->add();
				if ($re) {
					$this->success('添加分类成功',U('Admin/GoodsTypes/addTypes'));exit;
				}else{
					$this->error('添加失败',U('Admin/GoodsTypes/addTypes'));exit;
				}
			}else{
				$info = $typeDb->getError();
				$this->assign('info',$info);
			}
		}
		$option = $typeDb->showOption();
		$this->assign('option',$option);
		$this->display();
	}
	//分类列表
	public function listType(){
		$typeDb = D('GoodsTypes');
		//思路:通过递归显示分类列表，然后分页显示
		
		$tr_str = $typeDb->typeList();
		$option_str=$typeDb->showType();
		$this->assign('tr_str',$tr_str);
		$this->assign('option',$option_str);
		//echo $tr_str;exit;
		$this->display();
	}
	//分类搜索
	public function searchType(){
		//print_r($_GET);exit;//返回的是分类id（typeid）
		$typeid = $_GET['search_name'];
		$typeDb = D('GoodsTypes');
		$option_str=$typeDb->showType();
		//$arr = $typeDb ->where("typeid=$typeid")->find();	
		$str = $typeDb->typeList($typeid);	
		$this->assign('arr',$str);
		$this->assign('option',$option_str);
		$this->display();
	}
	//回收分类(把isdel改为0)
	public function huishouType(){
		//print_r($_POST);exit;
		$typeDb = D('GoodsTypes');
		foreach ($_POST['id'] as $v){
			$re = $typeDb->where('typeid='.$v)->save(array('isdel'=>0));
		}
		$path = $_SERVER['HTTP_REFERER'];
		header("Location:$path");			
	}
	//显示分类
	public function showType(){
		//print_r($_POST);exit;
		$typeDb = D('GoodsTypes');
		foreach ($_POST['id'] as $v){
			$re = $typeDb->where('typeid='.$v)->save(array('isdel'=>1));
		}
		$path = $_SERVER['HTTP_REFERER'];
		header("Location:$path");
	}
	//删除分类
	public function deleteType(){
		$typeDb = D('GoodsTypes');
		foreach ($_POST['id'] as $v){
			$re = $typeDb -> where("typeid=$v")->delete();
		}		
		$path = $_SERVER['HTTP_REFERER'];
		header("Location:$path");
	}
	//修改分类
	public function updateType(){
		$typeid = $_GET['typeid'];
		if ($_POST) {
			//接收数据  更新分类
			//print_r($_POST);exit;
			$typeDb = D('GoodsTypes');
			if ($typeDb->create()) {
				$typeDb->where('typeid='.$typeid)->save();
				$this->redirect('Admin/GoodsTypes/listType');
				/* $path = $_POST['url'];
				header("Location:$path"); */
			}else{
				//获取错误信息   传递给模板
				$info = $typeDb->getError();
				$this->assign('info',$info);
				$this->assign('post',$_POST);
			}
		}
			//显示修改页面   传此分类下的值  传下拉列表			
			$typeDb = D('GoodsTypes');		
			$typeValue = $typeDb->where("typeid=$typeid")->find();
			$optionStr = $typeDb->showOPtion(0,0,$typeValue['fid']);
			$this->assign('optionStr',$optionStr);
			$this->assign('typeValue',$typeValue);
			$this->display();
	}	
}






















