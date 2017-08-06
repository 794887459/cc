<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller{
	public function _initialize(){
		if (!isset($_COOKIE['aid'])) {
			$this->redirect('Admin/Login/login');
		}
	}
}