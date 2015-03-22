<?php

class UserController extends Controller
{
    function actionLogin()
    {
        // var_dump(Yii::app()->db);
        //echo 'i want login system';
        // $this->render('login');//显示头部信息
        $this->render('login');
    }

    function actionRegister()
    {
        //echo 'i want login system';
        // $this->render('login');//显示头部信息
        $this->render('register');
    }
}