<?php

// This is the database connection configuration.
return array(
	'class' => 'CDbConnection',
	// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/simplesimrs.db',
	//PostgreSQL
	// 'connectionString' => 'pgsql:host=localhost;port=5432;dbname=klinik',
	//MySQL
	'driverName' => 'mysql',
	'connectionString' => 'mysql:Driver={MySQL};Server=127.0.0.1;dbname=klinik',
	'username' => 'root',
	'password' => '',
	'enableProfiling' => true,
    'enableParamLogging' => true,
	// uncomment the following lines to use a MySQL database
	/*
	'connectionString' => 'mysql:host=localhost;dbname=testdrive',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/
);
