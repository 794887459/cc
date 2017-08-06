<?php
//会员操作类
namespace Home\Model;
use Think\Model;
class UsersModel extends Model{
	protected $tableName="users";
	protected $patchValidate=true;//开启批量验证
	//自动验证
	protected $_validate = array(
			array('checkcode','require','*必填'),
			array('username','','用户名存在',0,'unique',1),//验证用户名唯一
			//array('username','[\u4e00-\u9fa5a-zA-Z0-9\-]{4,20}','用户名格式错误','regex'),//验证用户名格式
			array('password','/^(?![\d]+$)(?![a-zA-Z]+$)(?![^\da-zA-Z]+$).{6,20}$/','密码格式错误'),//验证密码格式
			array('repassword','password','两次密码不一致',0,'confirm'),//验证两次密码是否一致
			//array('username','','用户名存在',0,'confirm',3)
	);
	//自动完成
	protected $_auto = array(
			array('password','md5',3,'function')
	); //^[\u4e00-\u9fa5_a-zA-Z0-9]+$   [\u4e00-\u9fa5a-zA-Z0-9\-]{4,20}  ^[\u4e00-\u9fa5a-zA-Z0-9—\-]{4,20}$
}