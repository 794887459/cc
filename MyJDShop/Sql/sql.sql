# 京东商城数据库
create database myjdshop character set utf8;
use myjdshop;

-- 后台管理员表
create table admin(
  aid   		int	key	auto_increment,
  username		varchar(20) unique not null,
  password		char(32)	not null,
  aname			varchar(10) not null,
  loginnum		int	default 0, 
  ip			varchar(50) default '127.0.0.1',
  logintime		timestamp default current_timestamp
);
insert admin(username,password,aname) values('admin','e10adc3949ba59abbe56e057f20f883e','陈陈');
insert admin(username,password,aname) values('tom','e10adc3949ba59abbe56e057f20f883e','汤姆');

-- 产品分类表
create table goodstype(
  typeid		int key auto_increment,
  typename		varchar(20) unique not null,
  fid			int not null
);
insert goodstype(typename,fid) values('家用电器',0);

-- 品牌表(品牌id 品牌名称  所属分类  )
create table brand(
  brandid		int key auto_increment,
  brandname		varchar(30) unique not null,
  imagename		varchar(50) not null,
  typeid		int	not null,
  isdel			int default 1
);
-- 产品表(产品id 产品名称  产品分类 产品内容  产品规格  价格  会员价格  优惠价格  优惠数量 库存  品牌  评论数  产品状态  是否回收 添加时间  点击数)
create table producu(
  productid		int key auto_increment,
  productname	varchar(30) not null,
  typestr		varchar(100) not null,
  content		text	not null,
  style			text	not null,
  price			varchar(20) not null,
  vipprice		varchar(20) not null,
  yhprice		varchar(20) not null,
  yhnum			varchar(20) not null,
  libnum		int	unsigned	not null,
  brandid		int	not null,
  reviewnum		int	default 0,
  state			tinyint	default 0,		#0代表普通商品   1代表热卖推荐	2代表新品推荐   3代表促销商品
  isdel			tinyint	default 1,
  addtime		timestamp default current_timestamp,
  salesnum		int	default 0,
  clicknum		int	default 0,
);
-- 产品图片表
create table productimage(
  imageid			int key auto_increment, 
  productid		int not null,
  imagename		varchar(50) not null  
);

-- 会员表(会员id 用户名  密码  昵称  手机号  邮箱  等级  积分(每个商品都有积分)  状态  创建时间)
create table users(
  userid		int key auto_increment,
  username		varchar(40) unique not null,
  password		char(32)	not null,
  nickname		varchar(10) default '菜鸟',
  phone			char(20)	unique ,
  email			varchar(30) unique ,
  level			int default 0  ,
  integral		int default 0 ,  #100积分为1级
  state			tinyint default 0,
  addtime		timestamp default current_timestamp
);

-- 购物车表(id 会员id 商品id 数量  规格)
create table cart(
  cartid  		int key auto_increment,
  userid		int not null,
  productid		int not null,	
  num			int not null,
  xiaoji		varchar(20) not null,
  style			varchar(50) not null
);

-- 用户送货信息表(id 会员id 收货人  收货地址  手机号  )
create table userinfo(
  id		int key auto_increment,
  userid 	int not null,
  name		varchar(10)	not null,
  addr		varchar(100) not null,
  phone		char(20) not null,
  state		tinyint default 0   # 1:默认
);
alter table userinfo add smode 		varchar(50) 	default '普通快递' 	not null;
alter table userinfo add stime 		varchar(50) 	default '时间不限' 	not null;
alter table userinfo add pay 		varchar(50) 	default '在线支付' 	not null;
alter table userinfo add fhead 		varchar(50) 	default '个人' 		not null;
alter table userinfo add fcontent 	varchar(50) 	default '明细' 		not null;
insert userinfo(userid,name,addr,phone) values(1,'陈陈','北京市 昌平区 南邵镇何营路北郡嘉源1号楼501','13331052156');
insert userinfo(userid,name,addr,phone,state) values(1,'陈贞洁','北京市 昌平区 南邵镇何营路北郡嘉源1号楼501','15910509710',1);

-- 地区表(id 地区名  fid)
create table city(
  cid  		int key auto_increment,
  cname		varchar(30)  not null,
  fid		int	 not null
);
insert into city(cid,cname,fid) value(1,'河北',0);
insert into city(cid,cname,fid) value(2,'承德',1);
insert into city(cid,cname,fid) value(3,'丰宁',2);
insert into city(cid,cname,fid) value(4,'河南',0);
insert into city(cid,cname,fid) value(5,'平顶山',4);
insert into city(cid,cname,fid) value(6,'叶县',5);
insert into city(cid,cname,fid) value(7,'舞钢',5);

-- 订单表(存储订单信息：送货信息)
create table orderinfo
(
  id          int             auto_increment primary key,	#id号
  orderNum     varchar(20)    unique not null,				#订单编号
  totalPrice  float           not null,						#订单总价
  userid      int             not null,						#下订单的人
  name     	  varchar(20)     not null,						#收件人
  phone       varchar(20)     not null,						#收件人的电话
  addr        varchar(500)    not null,						#送货地址
  stime		  varchar(10)	  not null,						#送货时间
  pay		  varchar(10)     not null,						#支付方式
  fhead		  varchar(20)	  not null,						#发票抬头
  fcontent	  varchar(10)	  not null,						#发票信息
  remark      varchar(1000)   default '无',					#订单描述
  isPay       int             default 0,					#是否付款(0未 1己)
  isSend      int             default 0,					#是否发货(0未 1己)
  isCheck     int             default 0,					#是否签收(0未 1己)
  dataandtime timestamp       default current_timestamp
);

-- 订单明细表(记录某个订单下的产品信息)
create table orderdetails
(
  odid         int             auto_increment primary key,
  orderid      int             not null,	#订单表的主键
  productid    int             not null,	#产品编号
  num   int             default 0,	#产品数量
  style varchar(20)	   not null 	#产品规格
);

-- 商品点击表(商品id 用户id 点击时间)
create table click(
  clickid		int				auto_increment key,
  productid		int				not null,
  userid		int				not null,
  clicktime		timestamp       default current_timestamp
);

-- 京东广告表
create table adv(
  advid 		int				auto_increment key,
  title			varchar(50)		not null,
  imagename		varchar(50)		not null,
  link			varchar(50)		not null,
  state			tinyint			not null
);













