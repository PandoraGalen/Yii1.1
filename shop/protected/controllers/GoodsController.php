<?php
/**
 * 商品控制器
 */
class GoodsController extends Controller {
    /*
     * 商品列表页面
     */
    function actionCategory(){
        //渲染视图
        //render() 带布局渲染
        //renderPartial()  部分渲染
        // $this -> renderPartial('category');
        $this -> render('category');
    }
    
    /*
     * 商品详细页面
     */
    function actionDetail(){
        // $this ->renderPartial('detail');
        $this ->render('detail');
    }
}