<?php
Yii::setPathOfAlias('common', dirname(__FILE__).  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('elephant', dirname(__FILE__).  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'elephant');
Yii::setPathOfAlias('authpath', dirname(__FILE__).'/../modules/auth');
if(!is_dir(Yii::getPathOfAlias('webroot').'/files/')) {
   mkdir(Yii::getPathOfAlias('webroot').'/files/');
   chmod(Yii::getPathOfAlias('webroot').'/files/', 0777);
   chmod(Yii::getPathOfAlias('webroot').'/files/image/', 0777);
   chmod(Yii::getPathOfAlias('webroot').'/files/application/', 0777);
   chmod(Yii::getPathOfAlias('webroot').'/files/video/', 0777);
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
		//'less', // preload the component to allow for automatic compilation
	),

	// autoloading model and component classes
	'import'=>array(
        'common.components.*',
        'common.extensions.*',
        'common.models.*',
		'common.extensions.PasswordHash',
        'elephant.components.*',
		'elephant.models.*',
	),
	'aliases' => array(
		'xupload' => 'common.extensions.xupload'
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'@Gouden7',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(// the twitter-bootstrap component
				'bootstrap.gii',
			),
		),
		'auth' => array(
			'strictMode' => false, // when enabled authorization items cannot be assigned children of the same type.
			'userClass' => 'Admin', // the name of the user model class.
			'userIdColumn' => 'id', // the name of the user id column.
			'userNameColumn' => 'leden_personeelsnummer', // the name of the user name column.
			//'appLayout' => 'elephant.modules.auth.views.layouts.main', // the layout used by the module.
			'viewDir' => null, // the path to view files to use with this module.
		),		
	),
	// bepaal basis taal voor app
	//'sourceLanguage'=>'en',
	'language'=>'nl',
	// application components
	'components'=>array(
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
			'connectionString' => 'mysql:host=localhost;port=3307;dbname=personeelsvereniging',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'usbw',
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
			'timeout' => 60000,
			//'autoCreateSessionTable '=> false,
		),
		'bootstrap'=>array(
			'class'=>'common.extensions.twitterbootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
			'responsiveCss' => true,
		),
		/*'less'=>array(
			'class'=>'common.extensions.lesscompiler.components.LessCompiler',
			'forceCompile'=>true, // indicates whether to force compiling
			'paths'=>array(
				'../elephant/less/style.less'=>'css/style.css',
			),
		),*/
		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
			'behaviors' => array(
				'auth' => array(
					'class' => 'authpath.components.AuthBehavior',
					'admins' => array('admin',), // users with full access
				),
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'authpath.components.AuthWebUser',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
	'behaviors' => array(
		'onBeginRequest' => array(
			'class' => 'common.components.RequireLogin'
		)
	),
);