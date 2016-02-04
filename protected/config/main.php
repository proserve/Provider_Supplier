<?php
define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));

$localConfig = array(
    'components' => array(
        'message' => array(
            'source' => 'MPhpMessageSource'
        ),
        'cache' => array(
            'class' => 'CDbCache',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=provider',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'ps_',
            /*  'enableProfiling' => true,
          'enableParamLogging' => true,*/
            'schemaCachingDuration' => 3600,
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages

                array(
                    'class' => 'CWebLogRoute',
                ),

            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    ),

);
$remoteConfig = array(
    'components' => array(

        'db' => array(
            'connectionString' => 'mysql:host=127.5.149.3;port=3306;dbname=provider' ,
            'emulatePrepare' => true,
            'username' => "adminMcWSKSH",
            'password' => "AYPiMDU6YRxL",
            'charset' => 'utf8',
            'tablePrefix' => 'ps_',


        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
        ),


        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        /*'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '192.168.1.215'),
                ),
            ),
        ),*/
    ),
);
$config = array(

    'theme' => 'blackboot',

    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => Yii::t('app', 'Provider Selector'),

    'preload' => array('bootstrap', 'log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.themes.bootstarp.views.layouts.main',
    ),
    'modules' => array(

        // uncomment the following to enable the Gii tool
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
        ),


    ),
    // application components
    /*  'components' => array(
          'user' => array(
              // enable cookie-based authentication
              'allowAutoLogin' => true,
          ),
          'bootstrap' => array(
          'class' => 'ext.bootstrap.components.Bootstrap',
          'responsiveCss' => true,
      ),

          // uncomment the following to enable URLs in path-format

            'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
            '<controller:\w+>/<id:\d+>'=>'<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
            ),

          /* 'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
            ), */
    // uncomment the following to use a MySQL database
    /* 'db' => array(
         'connectionString' => 'mysql:host=mysql.hostinger.ae;dbname=u909221893_vmana',
         'emulatePrepare' => true,
         'username' => 'u909221893_root',
         'password' => 'aso19920217',
         'charset' => 'utf8',
         'tablePrefix' => 'tl_',
),

     'errorHandler' => array(
         // use 'site/error' action to display errors
         'errorAction' => 'site/error',
     ),

 ),*/
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'ak_ghiboub@esi.dz',
    ),

);
if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1') {
    $config = array_merge($config, $localConfig);
} else {
    $config = array_merge($config, $remoteConfig);
}
return $config;