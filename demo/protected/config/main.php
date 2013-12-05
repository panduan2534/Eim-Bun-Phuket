<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/editable');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=> 'Eim-Bun Phuket - Admin',
	'theme'=>'bootstrap',
	//'theme'=>'abound',
	
	// preloading 'log' component
	'preload'=>array('log'),
	'timeZone' => 'Asia/Bangkok',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'editable.*',
	),
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'password',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
					'bootstrap.gii',
			),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// There you go, use our 'extended' version
			'class'=>'EWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
		),
		'editable' => array(
			'class'     => 'editable.EditableConfig',
			'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain'
			'mode'      => 'popup',            //mode: 'popup' or 'inline'
			'defaults'  => array(              //default settings for all editable elements
				'emptytext' => 'Click to edit'
				),
		
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
// 		'db'=>array(
// 			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
// 		),
		// uncomment the following to use a MySQL database
	
		'db'=>array(
			'connectionString' => 'mysql:host=mysql.hostinger.in.th;dbname=u407317669_eb',
			'emulatePrepare' => true,
			'username' => 'u407317669_root',
			'password' => 'm5NP5GcMwY',
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
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
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