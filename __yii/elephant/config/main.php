<?php
//Yii::setPathOfAlias('bootstrap', dirname(__FILE__).  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '/common/extensions/twitterbootstrap');
Yii::setPathOfAlias('common', dirname(__FILE__).'/../../common');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../../common/extensions/twitterbootstrap');
//Yii::setPathOfAlias('common', dirname(__FILE__).  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'common');
//Yii::setPathOfAlias('common', DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'common');
//Yii::setPathOfAlias('common', dirname(__FILE__).  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('elephant', dirname(__FILE__).  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'elephant');
if(!is_dir(Yii::getPathOfAlias('webroot').'/files/')) {
   //mkdir(Yii::getPathOfAlias('webroot').'/files/');
   //chmod(Yii::getPathOfAlias('webroot').'/files/', 0777);
  // chmod(Yii::getPathOfAlias('webroot').'/files/image/', 0777);
   //chmod(Yii::getPathOfAlias('webroot').'/files/application/', 0777);
   //chmod(Yii::getPathOfAlias('webroot').'/files/video/', 0777);
   // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
}

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Elephant management.',
	
	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap', // preload the twitter-bootstrap component [http://www.cniska.net/yii-bootstrap/setup.html]
	),

	// autoloading model and component classes
	'import'=>array(
        'common.components.*',
        'common.extensions.*',
        'common.models.*',
		'common.extensions.PasswordHash',
        'elephant.components.*',
		'elephant.models.*',
		//'elephant.modules.srbac.controllers.SBaseController',
	),
	'aliases' => array(
		'xupload' => 'ext.xupload',
	),
	'modules'=>array(
		
	),
	// bepaal basis taal voor app
	//'sourceLanguage'=>'en',
	'language'=>'nl',
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=deb1159279_rhino',
			'emulatePrepare' => true,
			'username' => 'deb1159279_rob',
			'password' => '@Gouden7',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace, info',
					'enabled'=> YII_DEBUG,
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
					'enabled'=> YII_DEBUG,
				),*/
				
			),
		),
		'session' => array (    
			'class' => 'system.web.CDbHttpSession',    
			'connectionID' => 'db',    
			'sessionTableName' => 'sessionsElephant',
			'timeout' => 600,
			//'autoCreateSessionTable '=> false,
		),
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		//'adminEmail'=>'webmaster@example.com',
	),
	'behaviors' => array(
		'onBeginRequest' => array(
			'class' => 'common.components.RequireLogin'
		)
	),
);