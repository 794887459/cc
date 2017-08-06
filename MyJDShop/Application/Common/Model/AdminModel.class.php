<?php
//后台管理员操作类
namespace Common\Model;
use Think\Model;
use Think\Verify;
class AdminModel extends Model{
	protected $tableName='admin';
	protected $patchValidate=true;
	//自动验证
	protected $_validate=array(
			array('username','require','请填写用户名'),
			array('password','require','请填写密码'),
			array('code','require','请填写验证码'),
			array('username','checkName','用户名错误',1,'callback',4),
			array('password','checkPwd','密码错误',1,'callback',4),
			array('code','checkCode','验证码错误',1,'callback',4)			
	);
	//验证用户名
	function checkName($username){		
		$re = $this -> where("username='{$username}'")->find();
		if ($re){
			return true;
		}else{
			return false;
		}
	}
	//验证密码
	function checkPwd($password){
		$pwd = md5($password);
		$re = $this -> where("password='{$pwd}'")->find();
		if ($re){
			return true;
		}else{
			return false;
		}
	}
	//验证验证码
	function checkCode($code){
		$verify = new Verify();
		$re = $verify ->check($code);
		if ($re){
			return true;
		}else{
			return false;
		}
	}	
}















