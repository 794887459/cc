<?php
//浏览历史控制器
namespace User\Controller;
class HistoryController extends MainController{
	//历史商品列表
	public function historyList(){
		$clickDb = D('click');
		//传历史商品(时间、商品图片、商品名字、商品id)
		$historyStr = showhistory();
		//print_r($historyStr);
		$this->assign('historyStr',$historyStr);
		$this->display();
	}
	
	//删除历史商品
	public function deleteHistory(){
		$clickDb = D('click');
		if (isset($_GET['productid'])) {
			$clickDb->where("productid={$_GET['productid']}")->delete();
		}else if (isset($_GET['clear']) && $_GET['clear']==0) {
			$sql = "truncate click";
			$clickDb->execute($sql);
			$path = $_SERVER['HTTP_REFERER'];
			header("Location: $path");exit;
		}else{
			$clickDb->where("clicktime={$_GET['clicktime']}")->delete();
		}
		$this->redirect('History/historyList');
	}
}