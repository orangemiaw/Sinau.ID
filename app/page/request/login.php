<?php

// Call model
require_once PATH_MODEL . 'model_admin.php';
require_once PATH_MODEL . 'model_participant.php';

$curl = new curl();
$m_admin = new model_admin($db);
$m_participant = new model_participant($db);


if(isset($_POST['login']) && isset($_POST['passwd']) && !empty($_POST['login']) && !empty($_POST['passwd'])) {
	$login 			= $_POST['login'];
	$password 		= $_POST['passwd'];
	$captcha 		= $_POST['g-recaptcha-response'];

	if(RECAPTCHA_STATUS) {
		$response		= $curl->get("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET_KEY."&response=".$captcha."&remoteip=".ip_address());
		$json_response 	= json_decode($response, true);

		if($json_response['success'] == false) {
			$notice->addError("Please, Solve the reCAPTCHA !");
			header("location:".HTTP."?page=login");
			return;
		}
	}

    $admin = $m_admin->auth($login, $password);
    if(!$admin) {
		$participant = $m_participant->auth($login, $password);
		if(!$participant) {
			$notice->addError("Wrong username or password !");
			header("location:".HTTP."?page=login");
			return;
		}
	}
	
	$_SESSION['login'] 		= true;
	$_SESSION['is_admin'] 	= $admin ? true : false;
	$_SESSION['username'] 	= $admin ? $admin['admin_login'] : $admin['participant_login'];
	$_SESSION['role'] 		= $admin ? json_decode($admin['admin_group_role']) : json_decode($participant['participant_group_role']);
	$_SESSION['group'] 		= $admin ? $admin['admin_group_name'] : $participant['participant_group_name'];
	$_SESSION['id'] 		= $admin ? $admin['admin_id'] : $participant['participant_id'];

	$notice->addSuccess("Welcome back <strong>".$login."</strong> !");
	header("location:".HTTP."?page=dashboard");
	return;
} else {
    $notice->addError("Please, Insert correctly !");
    header("location:".HTTP."?page=login");
	return;
}