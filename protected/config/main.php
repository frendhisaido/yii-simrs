<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
        'application.modules.user.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345678',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'Wilayah',
		'Obat',
		'Tindakan',
		'Pasien',
		'Pendaftaran',
		'user'=>array(
			# encrypting method (php hash function)
			'hash' => 'md5',

			# send activation email
			'sendActivationMail' => false,

			# allow access for non-activated users
			'loginNotActiv' => false,

			# activate user on registration (only sendActivationMail = false)
			'activeAfterRegister' => false,

			# automatically login from registration
			'autoLogin' => true,

			# registration path
			'registrationUrl' => array('/user/registration'),

			# recovery password path
			'recoveryUrl' => array('/user/recovery'),

			# login form path
			'loginUrl' => array('/user/login'),

			# page after login
			'returnUrl' => array('/user/profile'),

			# page after logout
			'returnLogoutUrl' => array('/user/login'),
		),
		'rbac'=>array(
			// Table where Users are stored. RBAC Manager use it as read-only
			'tableUser'=>'users', 
			// The PRIMARY column of the User Table
			'columnUserid'=>'id',
			// only for display name and could be same as id
			'columnUsername'=>'username',
			// only for display email for better identify Users
			'columnEmail'=>'email' // email (only for display)
			),
	),

	// application components
	'components'=>array(

		'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
		'authManager'=>array(
				'class'=>'CDbAuthManager', // Database driven Yii-Auth Manager
				'connectionID'=>'db', // db connection as above
			'defaultRoles'=>array('registered'), // default Role for logged in users
			'showErrors'=>true, // show eval()-errors in buisnessRules
		),
		'commandMap' => array(
			'migrate' => array(
				'class' => 'system.cli.commands.MigrateCommand',
				'migrationPath' => 'application.migrations',
				'migrationTable' => 'tbl_migration', // Optional, nama tabel migrasi
				'connectionID'=>'db',
				'templateFile'=>'application.migrations.template',
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

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
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
