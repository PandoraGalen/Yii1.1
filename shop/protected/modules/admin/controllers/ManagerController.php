<?php
/**
 * 后台管理员登录控制器
 */
class ManagerController extends Controller{
    /*
     * 实现用户登录
     */
    function actionLogin(){
        //调用模板
        $this ->renderPartial('login');
    }
    
}