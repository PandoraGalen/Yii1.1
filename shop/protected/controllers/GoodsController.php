<?php
/**
 * 商品控制器
 */
class GoodsController extends Controller {
    /*
     * 通过用户访问控制过滤实现页面缓存 
     * 过滤器：
     *  accessControl 是方法过滤器
     *  array()       是类过滤器
     */
    //update sw_goods set goods_big_img = concat('/',goods_big_img);
            //'accessControl',  方法过滤器
            //类过滤器 实现页面整体缓存 COutputCache.php
            //只针对detail进行页面缓存
    //         array(
    //             'system.web.widgets.COutputCache + detail',
    //             'duration'=>1800,
    //             'varyByParam'=>array('id'),
    //         ),
    //     );
    // }
    
    
    /*
     * 商品列表页面
     */
    function actionCategory(){
        //通过数据模型获得商品的全部信息
        $goods_model = Goods::model();
        
        //1. 获得全部记录数目
        $total = $goods_model->count();
        $per = 8;
        
        //2. 实例化分页类对象
        $page = new Pagination($total, $per);
        
        //3. 重新拼装具体的sql语句，有limit关键字
        $sql = "select * from {{goods}} {$page -> limit}";
        
        //4. 执行sql语句获得每页数据
        $goods_infos = $goods_model -> findAllBySql($sql);
        
        //5. 获得页码列表
        $page_list = $page -> fpage();
        
        
        //渲染视图
        //render() 带布局渲染
        //renderPartial()  部分渲染
        $this -> render('category',array('goods_infos'=>$goods_infos,'page_list'=>$page_list));
    }
    
    /*
     * 商品详细页面
     */
    function actionDetail($id){
        //通过缓存实现数据的读取
        //自定义方法getGoodsInfoByPk()，是模型model里边的一个方法
        //该方法可以根据具体id信息获得商品详细
        $goods_info = Goods::model()->getGoodsInfoByPk($id);
        
        //根据id获得当前商品详细信息
        //$goods_info = Goods::model()->findByPk($id);
        
        $this ->render('detail',array('goods_info'=>$goods_info));
    }
    
    function actionIndex(){
        echo "aaaaaaaaaaaaaaaaaa";
    }
    
    function actionHuan1(){
        //设置变量缓存
        Yii::app()->cache->set('username','zhangsan',3600);
        Yii::app()->cache->set('useraddr','beijing',3600);
        Yii::app()->cache->set('hobby','lanqiu',3600);
        echo "set cache is ok";
    }
    function actionHuan2(){
        //使用变量缓存
        echo Yii::app()->cache->get('username'),"<br />";
        echo Yii::app()->cache->get('useraddr'),"<br />";
        echo Yii::app()->cache->get('hobby'),"<br />";
        echo "use cache is ok";
    }
    
    function actionHuan3(){
        //删除缓存变量
        //Yii::app()->cache->delete('username');
        //清空缓存变量，也可以删除片段缓存或文件缓存
        Yii::app()->cache->flush();
    }

    
}