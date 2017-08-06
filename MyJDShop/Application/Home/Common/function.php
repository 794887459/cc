<?php
//获取全部商品分类
function getAllTypeToStr(){
	$typeDb = D('Goodstypes');
	$arrOne = $typeDb->where("fid=0")->select();
	$allTypeStr = '';
	foreach ($arrOne as $v1){ 
		$allTypeStr.="<div class=\"cat item1\">
					  		<h3><a href='".BASE_URL."index.php/Home/Product/productList/typeid/{$v1['typeid']}'>{$v1['typename']}</a> <b></b></h3>
					  			<div class=\"cat_detail\">
					 ";
		$arrTwo = $typeDb->where("fid={$v1['typeid']}")->select();
		foreach ($arrTwo as $v2){
			$allTypeStr.="<dl class=\"dl_1st\">
								<dt><a href='".BASE_URL."index.php/Home/Product/productList/typeid/>{$v1['typeid']}>{$v2['typeid']}>'>{$v2['typename']}</a></dt>  			 
								<dd>	
						 ";
			$arrThree = $typeDb->where("fid={$v2['typeid']}")->select();
			foreach ($arrThree as $v3){
				$allTypeStr.="<a href='".BASE_URL."index.php/Home/Product/productList/typeid/>{$v1['typeid']}>{$v2['typeid']}>{$v3['typeid']}>'>{$v3['typename']}</a>";
			}
			$allTypeStr.="</dd></dl>";
		}
		$allTypeStr.="</div></div>";
	}
	return $allTypeStr;
}
//显示面包屑
function showCrumbs($typeid){
	$typeDb = D('Goodstypes');
	$nameStr = '';
	if (is_numeric($typeid)) {
		$nameArr = $typeDb->where("typeid={$typeid}")->find();
		$nameStr.=$nameArr['typename'];
	}else {
		$typeid=str_replace ( '&gt;' , '>' , $typeid );
		$typeArr = explode('>',trim($typeid,'>'));
		//print_r($typeArr);
		foreach ($typeArr as $v){
			$url .= $v.'>';
			$nameArr=$typeDb->where("typeid=$v")->find();
			$nameStr .= " <code>&gt;</code> <a href='".BASE_URL."index.php/Home/Product/productList/typeid/>{$url}'>". $nameArr['typename'].'</a>';
		}
	}
	return $nameStr;
}
































