<?php

// Call model
require_once PATH_MODEL . 'model_change_log.php';

$m_log          = new model_change_log($db);
$url            = isset($_GET['url']) ? $_GET['url'] : false;
$page           = is_numeric($_GET['page']) ? $_GET['page'] : 1;
$data_per_page  = 20;

if($url) {
    $where['url_like'] = $url;
    $arr_log           = $m_log->get_results($where, $page, $data_per_page);

    $result = array();
	foreach ($arr_log as $value) {
		$result[] = array(
			'id'         => $value['log_id'],
			'created'    => timestamp_to_date($value['created']),
			'created_by' => $value['created_by'],
			'ip'         => $value['ip']
		);
	}
	ajax_output($result, 200);
    return;
} else {
    ajax_output('', 400, 'Bad Request');
    return;
}