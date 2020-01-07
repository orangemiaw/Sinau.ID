<?php

$id = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$action = isset($_GET['act']) ? $_GET['act'] : '';
$password = isset($_POST['txtNewPassword']) ? $_POST['txtNewPassword'] : '';
$repeat_password = isset($_POST['txtNewPasswordVerify']) ? $_POST['txtNewPasswordVerify'] : '';

if(empty($password) || empty($repeat_password)) {
    $callback['noty'] = array('type' => 'error', 'text' => 'Password can not be empty !');
	ajax_output('', 400, $callback);
    return;
}

if($password != $repeat_password) {
    $callback['noty'] = array('type' => 'error', 'text' => 'Password not match !');
	ajax_output('', 400, $callback);
    return;
}

if(strlen($password) < 6) {
    $callback['noty'] = array('type' => 'error', 'text' => 'Password must more than 6 character !');
	ajax_output('', 400, $callback);
    return;
}

if($_SESSION['is_admin']) {
    $fields = array(
        "admin_password" => encrypt_password($password)
    );

    $update = $db->update("admins", $fields, array('admin_id' => $_SESSION['id']));
      
    if(!$update) {
        $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
        ajax_output('', 503, $callback);
        return;
    }

    $callback['noty'] = array('type' => 'success', 'text' => 'Updated');
    ajax_output('', 200, $callback);
    return;
} else {
    $fields = array(
        "participant_password" => encrypt_password($password)
    );

    $update = $db->update("participants", $fields, array('participant_id' => $_SESSION['id']));
      
    if(!$update) {
        $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
        ajax_output('', 503, $callback);
        return;
    }

    $callback['noty'] = array('type' => 'success', 'text' => 'Updated');
    ajax_output('', 200, $callback);
    return;
}