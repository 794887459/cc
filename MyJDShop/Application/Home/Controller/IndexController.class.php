<?php
//京东首页控制器
namespace Home\Controller;
class IndexController extends HomeController {
    public function index(){
    	/* $mem = New \Memcache();				//实例化memcache对象
    	$mem->connect('localhost',11211);	//连接memcache服务器
        $mem->set('test', 'test');			//设置一个变量到内存中
    	$getValue = $mem->get('test');		//获取缓存中的数据
    	echo $getValue; */
    	
    	
    	
    	//传热卖商品
    	
    	$this->display();
    }
}