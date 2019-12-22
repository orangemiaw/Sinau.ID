<?php
defined('SINAUID') OR exit('No direct script access allowed');

$config['dashboard'] = array(
	'name'    => 'Dashboard',
	'methods' => array(
		array(
			'name' => 'SUMMARY',
			'key'  => 'index'
		)
	)
);

$config['change_logs'] = array(
	'name'    => 'Change Logs',
	'methods' => array(
		array(
			'name' => 'SUMMARY',
			'key'  => 'index'
		)
	)
);

$config['account_profile'] = array(
	'name'    => 'Account Profile',
	'methods' => array(
		array(
			'name' => 'PERSONAL INFO',
			'key'  => 'detail'
		),
		array(
			'name' => 'CHANGE PASSWORD',
			'key'  => 'change_password'
		)
	)
);

$config['module'] = array(
	'name'    => 'Module',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'PREMIUM ACCESS',
			'key'  => 'premium'
		)
	)
);

$config['question'] = array(
	'name'    => 'Question',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'RECORD',
			'key'  => 'record'
		),
		array(
			'name' => 'PREMIUM ACCESS',
			'key'  => 'premium'
		)
	)
);