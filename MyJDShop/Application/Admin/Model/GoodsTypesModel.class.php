<?php
//商品分类操作类
namespace Admin\Model;
use Think\Model;
class GoodsTypesModel extends Model{
	protected $tableName='goodstypes';
	//自动验证  （如果是批量验证的开启protected $patchValidate = true）
	protected $patchValidate = true;
	protected $_validate = array(
			array('typename','2,20','长度在2-20之间',0,'length'),//分类名长度在2-20之间
	);
	
	//显示多级分类(无限极分类)
	public function showOPtion($fid=0,$num=0,$selectid=0){
		//$typeid = $_GET['typeid'];
		$re = $this->where("fid=$fid")->select();
		$option = '';
		$gang = str_repeat('--', $num);
		$num++;
		foreach ($re as $v){
			if ($v['typeid']==$selectid) {
				$option.="<option value={$v['typeid']} selected='selected'>{$gang}{$v['typename']}</option>";
			}else{
				$option.="<option value={$v['typeid']}>{$gang}{$v['typename']}</option>";
			}	
				$str = $this->showOPtion($v['typeid'],$num,$selectid);
				$option .=$str;		
		}
		return $option;
	}
	
	
	//显示顶级分类
	public function showType($id=0){
		$typeid = $_GET['search_name'];
		$re = $this->where("fid=0")->select();
		$option = '';			
		foreach ($re as $v){
			if ($typeid==$v['typeid'] || $id==$v['typeid']){
				$option.="<option value={$v['typeid']} selected>{$v['typename']}</option>";
			}else{
				$option.="<option value={$v['typeid']}>{$v['typename']}</option>";
			}	
		}
		return $option;
	}
	//显示分类列表
	public function typeList($fid=0,$num=0){
		/* ???怎么使用分页 */
		$arr1 = $this->where('fid='.$fid)->select();
		$list = '';
		$gang = str_repeat('--', $num);
		$num++;
		$a=1;
		foreach ($arr1 as $v){	
			$imgaepath=$v['isdel']?BASE_URL.'Public/Admin/images/show.png':BASE_URL.'Public/Admin/images/hidden.png';
			$list.="<tr id='product1'>
					<td><input type='checkbox' name='id[]' value='{$v['typeid']}'/></td>
					<td>{$gang}{$v['typename']}</td>
					<td><img src='{$imgaepath}'></td>
					<td><a href='updateType/typeid/{$v['typeid']}'>修改</a></td>					
					</tr>";
			$str = $this->typeList($v['typeid'],$num);
			$list.=$str;					
		}
		return $list;
	}
	//显示多级分类（value值为字符串形式：>1>2>3>  家用电器>电视>曲面电视>）
	public function showOptionBystr($fid=0,$num=0,$selectid=0,$typeStr=''){
		$re = $this->where("fid=$fid")->select();
		$optionStr='';
		$gang = str_repeat('--', $num);
		$num++;
		$a='';
		if (is_string($selectid)) {
			$selectid=explode('&gt;',trim($selectid,'&gt;'))[0];
		}
		foreach ($re as $v){
			if ($selectid==$v['typeid']){
				$optionStr.="<option value='{$typeStr}>{$v['typeid']}>' selected>{$gang}{$v['typename']}</option>";
			}else{
				$optionStr.="<option value='{$typeStr}>{$v['typeid']}>'>{$gang}{$v['typename']}</option>";
			}
			$a="{$typeStr}>{$v['typeid']}";
			$str = $this->showOptionBystr($v['typeid'],$num,$selectid,$a);
			$optionStr.=$str;
		}
		return $optionStr;
	}
}





















