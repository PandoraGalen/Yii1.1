<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	//设置系统默认控制器
	'defaultController'=>'index',
	// preloading 'log' component
	'preload'=>array('log'),
    //配置主题theme
    'theme'=>'children',
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'aaaaaa',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		//引入我们创建的后台模块admin
		'admin'
		
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>'./index.php?r=user/login',
		),

		// uncomment the following to enable URLs in path-format

//		'urlManager'=>array(
//                    'urlFormat'=>'path',
//                    'rules'=>array(
//                        //user/login.html ===> user/login
//                        'user/login'=>array('user/login','urlSuffix'=>'.html'),
//
//                        //user/register.html  ===>  user/register
//                        'user/register'=>array('user/register','urlSuffix'=>'.html'),
//
//                        //goods/20   ====>  goods/detail&id=20
//                        'goods/<id:\d+>' => 'goods/detail',
//
//                        //goods/20/zhangsan  ===> goods/category&id=20&name=zhangsan
//                        'goods/<id:\d+>/<name:[a-z]+>'=>'goods/category',
//
//                        //goods/4-2-3-5.html  ===> goods/category&brand=4&price2&color=3&screen=5
//                        'goods/<brand:\d+>-<price:\d+>-<color:\d+>-<screen:\d+>'=>array('goods/category','urlSuffix'=>'.html'),
//                    ),
//		),


		// 'urlManager'=>array(
		// 	'urlFormat'=>'path',
		// 	'rules'=>array(
		// 		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
		// 		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		// 		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		// 	),
		// ),
		
		'cache'=>array(
			'class' =>'system.caching.CFileCache', ),
		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
