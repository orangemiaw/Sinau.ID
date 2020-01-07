<?php

$id         = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$action     = isset($_GET['act']) ? $_GET['act'] : '';
$name       = isset($_POST['txtFullName']) ? $_POST['txtFullName'] : '';
$address    = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
$province   = isset($_POST['cbProvince']) ? $_POST['cbProvince'] : '';
$regencie   = isset($_POST['cbRegencie']) ? $_POST['cbRegencie'] : '';
$postalcode = isset($_POST['txtPostalCode']) ? $_POST['txtPostalCode'] : '';
$telephone  = isset($_POST['txtTelephone']) ? $_POST['txtTelephone'] : '';

if(!empty($id) && !empty($name) && !empty($address) && !empty($province) && !empty($regencie) && !empty($postalcode) && !empty($telephone)) {
    $doUpload = $upload->go('image_file', PATH_KTP);
    if($doUpload['status'] == false) { 
        $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
        ajax_output('', 400, $callback);
        return;
    }

    $fields = array(
        "participant_name"  => $name,
        "profile_image"     => PATH_KTP . $doUpload['file'],
        "address"           => $address,
        "regencie"          => $regencie,
        "province"          => $province,
        "postal_code"       => $postalcode,
        "telephone"         => $telephone
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
} else {
    $callback['noty'] = array('type' => 'error', 'text' => 'Please insert correctly !');
	ajax_output('', 400, $callback);
    return;
}