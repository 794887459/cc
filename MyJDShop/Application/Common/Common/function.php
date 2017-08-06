<?php
function getTypeStr($typestr){
	$typestr=trim($typestr,"&gt;");
	$typeArr=explode("&gt;",$typestr);
	$str="";
	$type=M('goodstypes');
	foreach($typeArr as $v){
		$arr=$type->where("typeid={$v}")->find();
		$str.="&gt;{$arr['typename']}";
	}
	return $str;
}
//传列表页菜单
function showCatList(){
	
	if (is_numeric($_GET['typeid'])) {
		$typeid = $_GET['typeid'];
	}else if(!isset($_GET['typeid'])){
		$typeid = 1;
	}else{
		$typeid = explode('>',trim($_GET['typeid'],'>'))[0];
	}
	
	$typeDb = D('goodstypes');
	$arr1 = $typeDb->where("typeid={$typeid}")->find();
	
	$catList = '';
		$arr2 = $typeDb->where("fid={$arr1['typeid']}")->select();
		$catList .= "<div class='catlist'>
						<h2>{$arr1['typename']}</h2>
						<div class='catlist_wrap'>";
		foreach ($arr2 as $v2){
			//$fid2 = $v2['typeid'];
			$arr3 = $typeDb->where("fid={$v2['typeid']}")->select();
			$catList .="<div class='child'>
						<h3 class='on'><b></b><a href='".BASE_URL."index.php/Home/Product/productList/typeid/>{$arr1['typeid']}>{$v2['typeid']}>'>{$v2['typename']}<a></h3>
						<ul>";
			foreach ($arr3 as $v3){
				$catList .="<li><a href='".BASE_URL."index.php/Home/Product/productList/typeid/>{$arr1['typeid']}>{$v2['typeid']}>{$v3['typeid']}>'>{$v3['typename']}</a></li>";
			}
			$catList .="</ul></div>";
		}
		$catList .="</div>
						<div style='clear:both; height:1px;'></div>
					</div>";
	return $catList;
}
//呈现城市下拉列表
function cityOption($cid=''){
	$cityDb = D('City');
	$optionStr = '';
	$cityArr = $cityDb->where("fid=0")->select();
	foreach ($cityArr as $v){
		$optionStr.="<option value='{$v['cid']}'>{$v['cname']}</option>";
	}
	return $optionStr;
}
//呈现地区地区下拉列表
function regionOption($cid){
	$cityDb = D('City');
	$regionStr = '';
	$regionArr = $cityDb->where("fid=$cid")->select();
	foreach ($regionArr as $v){
		$regionStr.="<option value='{$v['cid']}'>{$v['cname']}</option>";
	}
	return $regionStr;
}
//在字符串中指定位置插入相关字符
/**
* 指定位置插入字符串
* @param $str  原字符串
* @param $i    插入位置
* @param $substr 插入字符串
* @return string 处理后的字符串
*/
function insertToStr($str, $i, $substr,$charset='utf-8'){
	//指定插入位置前的字符串
	$startstr="";
	for($j=0; $j<$i; $j++){
		$startstr .= mb_substr($str, $j,1,$charset);
	}

	//指定插入位置后的字符串
	$laststr="";
	for ($j=$i; $j<mb_strlen($str,$charset); $j++){
		$laststr .= mb_substr($str, $j,1,$charset);
	}
	 
	//将插入位置前，要插入的，插入位置后三个字符串拼接起来
	$str = $startstr . $substr . $laststr;
	 
	//返回结果
	return $str;
}

//测试
/* $str="hello的的 zhidao解决!";
$newStr=insertToStr($str, 6, "baidu");
echo $newStr; */
//hello baiduzhidao!















