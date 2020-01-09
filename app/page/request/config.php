<?php

$action             = isset($_GET['act']) ? $_GET['act'] : '';
$server             = isset($_POST['txtFAServer']) ? $_POST['txtFAServer'] : '';
$login              = isset($_POST['txtFALogin']) ? $_POST['txtFALogin'] : '';
$password           = isset($_POST['txtFAPassword']) ? $_POST['txtFAPassword'] : '';
$pp_sandbox         = isset($_POST['txtPPSandbox']) ? $_POST['txtPPSandbox'] : '';
$pp_client_id       = isset($_POST['txtPPClientId']) ? $_POST['txtPPClientId'] : '';
$pp_client_secret   = isset($_POST['txtPPClientSecret']) ? $_POST['txtPPClientSecret'] : '';
$pp_status          = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : '';
$ovo_number         = isset($_POST['txtOVONumber']) ? $_POST['txtOVONumber'] : '';

if($action == 'update') {
    if($_SESSION['is_admin']) {
        $fields = array(
            "faceai_server"             => $server,
            "faceai_login"              => $login,
            "faceai_password"           => $password,
            "paypal_sandbox_account"    => $pp_sandbox,
            "paypal_client_id"          => $pp_client_id,
            "paypal_client_secret"      => $pp_client_secret,
            "paypal_live_payment"       => $pp_status,
            "ovo_number"                => $ovo_number
        );

        $update = $db->update("configs", $fields);
        
        if(!$update) {
            $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
            ajax_output('', 503, $callback);
            return;
        }

        $callback['noty'] = array('type' => 'success', 'text' => 'Updated');
        ajax_output('', 200, $callback);
        return;
    } else {
        $callback['noty'] = array('type' => 'success', 'text' => 'Permission denied');
        ajax_output('', 200, $callback);
        return;
    }
} else {
    $notice->addError("No action found in your requested url !");
    ajax_output(array(), 400, array('location' => '?page=config'));
}