<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'wp_wil',
	'username'  => 'root',
	'collation' => 'utf8_unicode_ci',
	'charset'   => 'utf8',
	'password'  => '',
	'prefix'    => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();