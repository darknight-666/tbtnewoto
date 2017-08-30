<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'defaultController' => 'admin/default/login', // 默认地址
    'name' => '通宝图',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'language' => 'zh_cn',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.widgets.*',
        'application.define.*',
        //rights
        'application.modules.rights.*',
        'application.modules.rights.components.*',
    ),
    'modules' => array(
        'admin', // 系统管理员模块
        'customer', // 用户模块
        'shop', // 商户模块
        // uncomment the following to enable the Gii tool
//        'gii' => array(
//            'class' => 'system.gii.GiiModule',
//            'password' => '123456',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters' => array('127.0.0.1', '::1'),
//        ),
        'rights' => array(
            'superuserName' => 'admin', //自己用户表里面的用户，这个作为超级用户
            'userClass' => 'Admin', //自己用户表对应的用户模型类
            'authenticatedName' => 'RightsAuthenticated', //自己起个喜欢的名字
            'userIdColumn' => 'id', //自己用户表对应的id栏
            'userNameColumn' => 'username', //自己用户表对应的栏
            'enableBizRule' => true,
            'enableBizRuleData' => false,
            'displayDescription' => true,
            'flashSuccessKey' => 'RightsSuccess',
            'flashErrorKey' => 'RightsError',
            'baseUrl' => '/rights',
            'layout' => 'rights.views.layouts.main',
            'appLayout' => 'application.views.layouts.mainRights',
            'install' => false, //第一次安装需要为true，安装成功以后记得改成false
            'debug' => false,
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser', //这个WebUser是继承CwebUser  
            'stateKeyPrefix' => 'user_', //这个是设置前台session的前缀  
            'allowAutoLogin' => true,
            'loginUrl' => array('admin/default/login')
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'assignmentTable' => 'oto_authassignment',
            'itemTable' => 'oto_authitem',
            'itemChildTable' => 'oto_authitemchild',
            'rightsTable' => 'oto_rights',
            'defaultRoles' => array('Guest'),
        ),
        //需要在runtime中增加SESSION目录
        'session' => array(
            'autoStart' => false,
            'sessionName' => 'TBT',
            'timeout' => 60 * 60 * 24 * 30,
            'cacheID' => 'cache',
            'class' => 'CCacheHttpSession',
        // 'cookieMode' => 'only',
        // 'cookieParams' => array('domain' => '.tongbaotu.com', 'lifetime' => 0),
//			去除 默认是/tmp 目录
//		   'savePath'=>'protected/runtime/SESSION/',
        ),
        // redis
        'cache' => array(
            'class' => 'system.caching.CRedisCache',
            'hostname' => '10.20.1.18',
            'port' => '6379',
            'password' => 'redistest',
            'database' => '9',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false, // 隐藏域名中的index.php
            'rules' => array(
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=192.168.1.150;dbname=tbt_oto',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'tbtmysql',
            'charset' => 'utf8',
            'tablePrefix' => 'oto_'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
//                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info, profile',
                    'categories' => 'newapi.*',
                    'logFile' => 'newapi.log',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params_local.php'),
);
