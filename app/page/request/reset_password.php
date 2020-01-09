<?php

// Call PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Call model
require_once PATH_MODEL . 'model_admin.php';
require_once PATH_MODEL . 'model_participant.php';

$m_admin = new model_admin($db);
$m_participant = new model_participant($db);

if(isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['code'])) {
    $reset_token = generate_token();
    $code = $_POST['code'];
    $password = $_POST['password'];
    $repeat_password = $_POST['confirm_password'];

    if(empty($password) || empty($repeat_password)) {
        $notice->addError("Password can not be empty !");
        header("location:".HTTP."?page=reset_password&code=" . $code);
        return;
    }
    
    if($password != $repeat_password) {
        $notice->addError("Password not match !");
        header("location:".HTTP."?page=reset_password&code=" . $code);
        return;
    }
    
    if(strlen($password) < 6) {
        $notice->addError("Password must more than 6 character !");
        header("location:".HTTP."?page=reset_password&code=" . $code);
        return;
    }

    $admin = $m_admin->get_row(array("admin_forgot_code" => $code, "admin_forgot_status" => STATUS_ENABLE));
    if(!$admin) {
        $participant = $m_participant->get_row(array("participant_forgot_code" => $code, "participant_forgot_status" => STATUS_ENABLE));
        if(!$participant) {
            $notice->addError("Token code expired or not found !");
            header("location:".HTTP."?page=login");
            return;
        } else {
			$fields = array(
				"participant_password" 	    => encrypt_password($password),
				"participant_forgot_code" 	=> NULL,
				"participant_forgot_status"	=> STATUS_DISABLE
			);
	
			$update = $db->update("participants", $fields, array("participant_id" => $participant['participant_id']));
			if(!$update) {
				$notice->addError("Query failed");
				header("location:".HTTP."?page=forgot_password");
				return;
			}
        }
    } else {
		$fields = array(
            "admin_password" 	    => encrypt_password($password),
			"admin_forgot_code" 	=> NULL,
			"admin_forgot_status"	=> STATUS_ENABLE
		);

		$update = $db->update("admins", $fields, array("admin_id" => $admin['admin_id']));
		if(!$update) {
			$notice->addError("Query failed");
			header("location:".HTTP."?page=forgot_password");
			return;
		}
    }

	$notice->addSuccess("Password changed successfully");
	header("location:".HTTP."?page=login");
	return;
} else {
    $notice->addError("Please, Insert correctly !");
    header("location:".HTTP."?page=login");
	return;
}