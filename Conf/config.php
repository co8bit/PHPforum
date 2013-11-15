<?php
return array(
	//'配置项'=>'配置值'
	'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	
	// 数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'forumBasedLBS', // 数据库名
	'DB_USER'   => 'forumBasedLBS', // 用户名
	'DB_PWD'    => '1234567890123', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀
	
	'SESSION_AUTO_START'    => true,    // 是否自动开启Session
	
	//'TMPL_ACTION_ERROR'     => THINK_PATH.'Public:error', // 默认错误跳转对应的模板文件
	//'TMPL_ACTION_SUCCESS'   => THINK_PATH.'Public:success', // 默认成功跳转对应的模板文件
);
?>