<?php
//广告操作类
namespace Admin\Model;
use \Think\Model;
class AdvModel extends Model{
	protected $tableName="adv";
	//开启批量验证
	protected $patchValidate=true;
	//自动验证
	protected $_validate=array(
			array('title','2-100','标题长度需在2-100之间','0','length'),//标题不能为空
			array('link','/^((http|ftp|https):\/\/)?[\w-_.]+(\/[\w-_]+)*\/?$/','链接格式错误')//链接格式符合正则
	);
}