<?php
//广告控制器
namespace Admin\Controller;
class AdvController extends BaseController{
	//添加广告
	public function addAdv(){
		if ($_POST){
			$advDb = D('adv');
			if ($advDb->create()) {
				//处理图片
				$upload=new \Think\Upload();
				$upload->autoSub=false;
				$upload->mimes=array('image/png',"image/gif","image/jpeg");
				$upload->rootPath="./Public/";
				$upload->savePath="Upload/advImages/";
				$imageArr=$upload->upload();
				if($imageArr){
					$_POST['imagename']=$imageArr['upload']['savename'];
				}
				//处理数据
				$advDb->add();
			}else{
				//提示错误
				$errorInfo = $advDb->getError();
				$this->assign('errorInfo',$errorInfo);
			}
		}else{
			$this->display();
		}
	}
	
	//广告列表
	public function listAdv(){
		$this->display();
	}
}