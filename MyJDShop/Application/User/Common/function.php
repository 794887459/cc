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
		print_r($typeArr);
		foreach ($typeArr as $v){
			$url .= $v.'>';
			$nameArr=$typeDb->where("typeid=$v")->find();
			$nameStr .= " <code>&gt;</code> <a href='".BASE_URL."index.php/Home/Product/productList/typeid/>{$url}'>". $nameArr['typename'].'</a>';
		}
	}
	return $nameStr;
}
//获取订单
function getOrderStr(){
	$orderDb = D('Orderinfo');
	$detailDb = D('orderdetails');
	$productDb = D('product');
	$imgDb = D('productimage');
	$orderStr = '';
	$orderArr = $orderDb->where("userid={$_COOKIE['userid']}")->order('id desc')->select();//查订单
	foreach ($orderArr as $v){
		$ab = strtotime("{$v['dataandtime']}+1day")-time();
		$ab = date('H:i:s',$ab);
		$a=true;
		$orderid = $v['id'];
		$detailArr = $detailDb->where("orderid={$orderid}")->select();//查订单详细
		$orderStr .= "<tbody class='tbody'>
		<tr><td style='border: 0;' colspan=5></td></tr>
		<tr class='tr-th'>
		<td colspan=5>
		<span class='gap'></span>
		<span class='dealtime' title='{$v['dataandtime']}'>{$v['dataandtime']}</span>
		<span class='number'>订单号：<font color='#333'>{$v['ordernum']} | {$ab}</font></span>
		</td>
		</tr>";
		foreach ($detailArr as $v1){
			$productid = $v1['productid'];
			$imgArr = $imgDb->where("productid={$productid}")->find();//查图片
			$productArr = $productDb->where("productid={$productid}")->select();//查产品
			foreach ($productArr as $k=>$v2){
				$v2['imagename'] = $imgArr['imagename'];
				$orderStr .="<tr>
						<td>
							<div class='goods-item'>
								<div class='p-img'><a href='' ><img src='".BASE_URL."Public/Upload/Product/{$v2['imagename']}'></a></div>
								<div class='p-msg'>
		                        	<div class='p-name'><a href='' class='a-link'>{$v2['productname']}</a></div>
		                        </div>
		                        <div class='goods-number'>x1</div>	
		                    </div>
						</td>";
				
				if($a){
				$orderStr .="<td rowspan=99>{$v['name']}</td>
							<td rowspan=99>{$v['totalprice']}</td>
							<td rowspan=99>";
				
				if (time()>strtotime("{$v['dataandtime']}+1day")) {
					$orderStr .="<div style='color:#ccc;margin-bottom:10px;'>已取消</div>";
				}
				
				$orderStr .="未付款
							</td>
							<td rowspan=99>
								<div class='operate'><a href='' class='btn-pay'>付款</a></div>
								<a href='".__APP__."/User/Order/orderDetail/orderid/{$v['id']}'>订单详情</a> | 
								<a href='".__APP__."/User/Order/deleteOrder/orderid/{$v['id']}' class='del'>删除</a>
							</td>";
				}	
				$a=false;	
				$orderStr .="</tr>";
			}
		}
		$orderStr .="</tbody>";
		}
		return $orderStr;
		}

//浏览历史
function showhistory(){
	$clickDb = D('click');
	$pimageDb = D('productimage');
	$productDb = D('product');
	$historyStr = '';
	$arr1 = $clickDb->order('clickid desc')->where("userid={$_COOKIE['userid']}")->group('clicktime')->select();
	//循环日期
	foreach ($arr1 as $v1){
		$historyStr .= "<div class='goods-content'>
						<div class='mt'>
						<strong>{$v1['clicktime']}</strong>
						<span class='del-all'><a href='deleteHistory/clicktime/{$v1['clicktime']}'>删除</a></span>
						</div>
						<div id='p-list'>";
		//根据日期得到商品id(根据商品id查图片、查商品)
		$arr2 = $clickDb->where("clicktime='{$v1['clicktime']}'")->group('productid')->select();
		//循环图片
		foreach ($arr2 as $v2){
		$productid = $v2['productid'];
				$arr3 = $pimageDb->where("productid={$productid}")->find();//查图片
				$arr4 = $productDb->where("productid={$productid}")->select();//查商品
				foreach ($arr4 as $v4){
					$v4['imagename'] = $arr3['imagename'];					
						$historyStr .= "<div class='img_p'>
											<img src='".BASE_URL."Public/Upload/Product/{$v4['imagename']}' width='220px' height='220px' alt='{$v4['productname']}'/>
											<div class='p-price'><i class='J-p-1057210'>￥{$v4['vipprice']}</i><span class='p-del'><a href='deleteHistory/productid/{$v1['productid']}' title='删除'>×</a></span></div>
										</div>";
					
				}
		}
			$historyStr .="</div></div>";
	}
	return $historyStr;
}




























