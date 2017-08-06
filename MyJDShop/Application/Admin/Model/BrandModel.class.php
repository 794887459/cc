<?php
//商品品牌操作类
namespace Admin\Model;
use \Think\Model;
class BrandModel extends Model{
	protected $tableName="brand";
	//自动验证
	
	protected $_validate = array(			 
			array('brandname','2,30','长度必须在2-30之间',0,'length'),//品牌名称长度2-30
			array('brandname','','品牌名被占用',0,'unique',1)//品牌唯一
	);   	
}
