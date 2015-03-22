<?php
/**
 * 商城首页控制器
 * 
 */
class IndexController extends Controller{
    /*
     * 展示首页
     */
    function actionIndex(){
        //渲染视图renderPartial()
        $this->render('index');
    }
}