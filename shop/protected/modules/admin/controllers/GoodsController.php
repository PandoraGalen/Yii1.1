<?php
/**
 * 后台商品管理控制器 
 */
class GoodsController extends Controller {
    /*
     * 商品展示
     */
    function actionShow(){
        //通过模型model实现数据表信息查询
        //产生模型model对象
        $goods_model = Goods::model();
        
        //通过model模型对象调用相关方法帮我们查询数据
        // $goods_infos = $goods_model -> find();  //每次只可以查询一条商品信息
        // // var_dump($goods_infos);
        // echo $goods_infos->goods_name,"<br />";
        // echo $goods_infos->goods_price,"<br />";
        // 
        //获得全部商品信息findAll()
        $goods_infos = $goods_model -> findAll();
        //获得全部商品名字的信息
        // var_dump($goods_infos);
        // foreach($goods_infos as $_v){
        //     //$_v就是遍历出来的具体对象
        //     echo $_v->goods_name,"----",$_v->goods_price,"<br />";
        // }
        // 
        // 
        //通过具体sql语句获得商品信息findAllBySql()
        // $sql = "select goods_name,goods_price,goods_create_time from {{goods}} limit 10";
        // $goods_infos = $goods_model ->findAllBySql($sql);
        
        //var_dump($goods_infos);


        // 
        //把获得数据信息传递到视图模板里边
        //renderPartial('视图名字',传递的变量信息);
        //renderPartial('show',array('名字'=>值,'名字'=>值));
        //名字：是视图使用的变量名字
        //值：当前被传递变量的值
        $this ->renderPartial('show',array('goods_infos'=>$goods_infos));
        $this ->renderPartial('show');
    }
    
    /*
     * 添加商品
     */
    function actionAdd(){
        $this ->renderPartial('add');
    }
    
    /*
     * 修改商品
     */
    function actionUpdate(){
        $this ->renderPartial('update');
    }
}