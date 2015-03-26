<?php

// This is the database connection configuration.
return array(
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	'connectionString' => 'mysql:host=localhost;dbname=yiishop',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => 'root',
	'charset' => 'utf8',
	//把数据表的前缀设置好
    'tablePrefix'=>'sw_',
    'enableParamLogging'=>true,
    //显示每个sql语句运行时间
    'enableProfiling'=>true,
);