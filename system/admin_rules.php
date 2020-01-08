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

$config['config'] = array(
	'name'    => 'Config',
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

$config['admin'] = array(
	'name'    => 'Admin',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		),
		array(
			'name' => 'CHANGE PASSWORD',
			'key'  => 'change_password'
		),
		array(
			'name' => 'TERMINATE',
			'key'  => 'terminate'
		)
	)
);

$config['admin_group'] = array(
	'name'    => 'Admin Group',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);

$config['participant'] = array(
	'name'    => 'Participant',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'CHANGE PASSWORD',
			'key'  => 'change_password'
		),
		array(
			'name' => 'TERMINATE',
			'key'  => 'terminate'
		)
	)
);

$config['participant_group'] = array(
	'name'    => 'Participant Group',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
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
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);

$config['module_group'] = array(
	'name'    => 'Module Group',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);

$config['module_type'] = array(
	'name'    => 'Module Type',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
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
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);

$config['question_group'] = array(
	'name'    => 'Question Group',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);

$config['question_type'] = array(
	'name'    => 'Question Type',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);

$config['answer'] = array(
	'name'    => 'Question Answer',
	'methods' => array(
		array(
			'name' => 'LIST',
			'key'  => 'index'
		),
		array(
			'name' => 'ADD',
			'key'  => 'add'
		),
		array(
			'name' => 'UPDATE',
			'key'  => 'update'
		),
		array(
			'name' => 'DETAIL',
			'key'  => 'detail'
		),
		array(
			'name' => 'DELETE',
			'key'  => 'delete'
		)
	)
);