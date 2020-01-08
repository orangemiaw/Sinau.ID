<?php

require_once PATH_MODEL . 'model_participant.php';
require_once PATH_MODEL . 'model_participant_group.php';
$m_participant  = new model_participant_group($db);
$m_group        = new model_participant_group($db);
$action         = isset($_GET['act']) ? $_GET['act'] : '';
$id             = is_numeric($_GET['id']) ? $_GET['id']/1909 : '';
$name           = isset($_POST['txtFullName']) ? $_POST['txtFullName'] : '';
$login          = isset($_POST['txtLogin']) ? $_POST['txtLogin'] : '';
$email          = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
$group          = isset($_POST['cbGroup']) ? $_POST['cbGroup'] : '';
$password       = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';
$password2      = isset($_POST['txtRepeatPassword']) ? $_POST['txtRepeatPassword'] : '';
$address        = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
$province       = isset($_POST['cbProvince']) ? $_POST['cbProvince'] : '';
$regencie       = isset($_POST['cbRegencie']) ? $_POST['cbRegencie'] : '';
$postalcode     = isset($_POST['txtPostalCode']) ? $_POST['txtPostalCode'] : '';
$telephone      = isset($_POST['txtTelephone']) ? $_POST['txtTelephone'] : '';
$status         = isset($_POST['cbStatus']) ? $_POST['cbStatus'] : '';

switch($action) {
    case 'add':
        if(!empty($_FILES["image_file"]["name"]) && !empty($name) && !empty($login) && !empty($email) && !empty($group) && !empty($password) && !empty($password2) && !empty($address) && !empty($province) && !empty($regencie) && !empty($postalcode) && !empty($telephone) && !empty($status)) {
            $name_available = $m_participant->get_row(array("participant_login" => $login));
            if($name_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Login username already used !');
				ajax_output('', 400, $callback);
                return;
            }

            $group_available = $m_group->get_row(array("participant_group_id" => $group));
            if(!$group_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Participant group not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if($password != $password2) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Password not match !');
                ajax_output('', 400, $callback);
                return;
            }
            
            if(strlen($password) < 6) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Password must more than 6 character !');
                ajax_output('', 400, $callback);
                return;
            }

            $doUpload = $upload->go('image_file', PATH_KTP);
            if($doUpload['status'] == false) { 
                $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                ajax_output('', 400, $callback);
                return;
            }

            $fields = array(
                "participant_name"      => $name,
                "participant_email"     => $email,
                "participant_login"     => $login,
                "participant_password"  => encrypt_password($password),
                "profile_image"         => PATH_KTP . $doUpload['file'],
                "address"               => $address,
                "regencie"              => $regencie,
                "province"              => $province,
                "postal_code"           => $postalcode,
                "telephone"             => $telephone,
                "participant_status"    => $status
            );

            $insert = $db->insert("participants", $fields);
      
            if(!$insert) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
				ajax_output('', 503, $callback);
                return;
            }
      
            $notice->addSuccess("Participant created successfully !");
            ajax_output('', 200, array('location' => '?page=participant'));
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'update':
        if(!empty($name) && !empty($login) && !empty($email) && !empty($group) && !empty($address) && !empty($province) && !empty($regencie) && !empty($postalcode) && !empty($telephone) && !empty($status)) {
            $name_available = $m_participant->get_row(array("participant_login" => $login));
            if($name_available) {
                $name_owned = $m_participant->get_row(array("participant_login" => $login, "participant_id" => $id));
                if(!$name_owned) {
                    $callback['noty'] = array('type' => 'error', 'text' => 'Login username already used !');
                    ajax_output('', 400, $callback);
                    return;
                }
            }

            $group_available = $m_group->get_row(array("participant_group_id" => $group));
            if(!$group_available) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Participant group not found !');
				ajax_output('', 400, $callback);
                return;
            }

            if(!empty($password) && !empty($password2)) {
                if($password != $password2) {
                    $callback['noty'] = array('type' => 'error', 'text' => 'Password not match !');
                    ajax_output('', 400, $callback);
                    return;
                }
                
                if(strlen($password) < 6) {
                    $callback['noty'] = array('type' => 'error', 'text' => 'Password must more than 6 character !');
                    ajax_output('', 400, $callback);
                    return;
                }

                $encrypt_password = encrypt_password($password);
            }

            if(!empty($_FILES["image_file"]["name"])) {
                $doUpload = $upload->go('image_file', PATH_KTP);
                if($doUpload['status'] == false) { 
                    $callback['noty'] = array('type' => 'error', 'text' => $doUpload['errors']);
                    ajax_output('', 400, $callback);
                    return;
                }

                $profile_image = PATH_KTP . $doUpload['file'];
            }

            $fields = array(
                "participant_name"      => $name,
                "participant_email"     => $email,
                "participant_login"     => $login,
                "address"               => $address,
                "regencie"              => $regencie,
                "province"              => $province,
                "postal_code"           => $postalcode,
                "telephone"             => $telephone,
                "participant_status"    => $status
            );

            if(!empty($encrypt_password)) {
                $fields['participant_password'] = $encrypt_password;
            }

            if(!empty($profile_image)) {
                $fields['profile_image'] = $profile_image;
            }

            $update = $db->update("participants", $fields, array('participant_id' => $id));

            if(!$update) {
                $callback['noty'] = array('type' => 'error', 'text' => 'Query failed');
                ajax_output('', 503, $callback);
                return;
            }
      
            $callback['noty'] = array('type' => 'success', 'text' => 'Updated');
            ajax_output('', 200, $callback);
            return;
        }

        $callback['noty'] = array('type' => 'error', 'text' => 'Please, Insert correctly !');
        ajax_output('', 400, $callback);
        break;
    case 'terminate':
        if(!empty($id)) {
            $fields = array(
                "participant_status" => STATUS_TERMINATE
            );

            $update = $db->update("participants", $fields, array('participant_id' => $id));

            if(!$update) {
                $notice->addError("Query failed !");
                header("location:".HTTP."?page=participant");
                return;
            }

            $notice->addSuccess("Participant terminated successfully !");
            header("location:".HTTP."?page=participant");
            break;
        }

        $notice->addError("Parameter id needed !");
        header("location:".HTTP."?page=participant");
        break;
    default:
        $notice->addError("No action found in your requested url !");
        ajax_output(array(), 400, array('location' => '?page=participant'));
        break;
}

?>