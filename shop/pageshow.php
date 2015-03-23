<?php

    /**
     *     分页类使用演示demo
     *     1. 连接数据库获得数据
     *     2. 使用分页类，对我们获得数据进行分页显示
     */

header("content-type:text/html;charset=utf-8");

//引入分页类
require_once('page.class.php');

$link = mysql_connect('localhost','root','root');
mysql_select_db('yiishop', $link);
mysql_query('set names utf8');

$sql = "select count(*) as cnt from sw_goods";
$qry = mysql_query($sql);
$rzt = mysql_fetch_assoc($qry);

$cnt = $rzt['cnt'];  //商品总的记录数目
$per = 6;            //每页显示6条数据

//通过分页类实现数据的分页显示
//实例化分页类对象
$page = new Page($cnt, $per);


//重新拼装sql语句，帮助我们获得每页信息
$sqla = "select * from sw_goods $page->limit";

$qrya = mysql_query($sqla);

while($rzta = mysql_fetch_assoc($qrya)){
    echo $rzta['goods_id'] ,"----",   $rzta['goods_name'],"<br />";
}

//输出页码列表
echo $page->fpage();
