<?php
//商品操作类
namespace Admin\Model;
use \Think\Model;
class ProductModel extends Model{
	protected $tableName='product';
	protected $patchValidate=true;//开启批量验证
	//自动验证
	protected $_validate = array(
			array('productname','2,130','名称长度必须在2-30之间',0,'length'),		
			array('price','/^\d{1,10}(\.\d{1,2})?$/','价格格式错误'),
			array('vipprice','/^\d{1,10}(\.\d{1,2})?$/','价格格式错误'),
			array('yhprice','/^\d{1,10}(\.\d{1,2})?$/','价格格式错误'),
			array('yhnum','/^\d{1,10}$/','请填写正确格式'),
			array('libnum','/^\d{1,10}$/','请填写正确格式'),
			array('content','10,10000','请填写不少于10个字',0,'length'),
			array('style','10,10000','请填写不少于10个字',0,'length')
	);
	
}