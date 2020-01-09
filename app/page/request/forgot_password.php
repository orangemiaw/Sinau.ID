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

function sendMail($address, $token) {
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'caludea1337@gmail.com';                // SMTP username
		$mail->Password   = 'd3.3v1l.klopAx_123';                          // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 465;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('support@sinau.id', 'Sinau ID');
		$mail->addAddress($address);

		// Content
		$mail->isHTML(true);
		$mail->Subject = 'Password Reset';
		$mail->Body    = '<h3>Dear member,</h3><br>You request a password reset, to reset your password click link bellow: <a href="' . HTTP . '?page=reset_password&code=' . $token . '">' . HTTP . '?page=reset_password&code=' . $token . '</a>';

		$mail->send();
		
		return true;
	} catch (Exception $e) {
		return false;
	}
}

if(isset($_POST['email'])) {
	$reset_token = generate_token();
	$email = $_POST['email'];

    $admin = $m_admin->get_row(array("admin_email" => $email));
    if(!$admin) {
		$participant = $m_participant->get_row(array("participant_email" => $email));
		if(!$participant) {
			$notice->addError("No account registered with this email !");
			header("location:".HTTP."?page=forgot_password");
			return;
		} else {
			$fields = array(
				"participant_forgot_code" 	=> $reset_token,
				"participant_forgot_status"	=> STATUS_ENABLE
			);
	
			$update = $db->update("participants", $fields, array("participant_email" => $email));
			if(!$update) {
				$notice->addError("Query failed");
				header("location:".HTTP."?page=forgot_password");
				return;
			}
		}
	} else {
		$fields = array(
			"admin_forgot_code" 	=> $reset_token,
			"admin_forgot_status"	=> STATUS_ENABLE
		);

		$update = $db->update("admins", $fields, array("admin_email" => $email));
		if(!$update) {
			$notice->addError("Query failed");
			header("location:".HTTP."?page=forgot_password");
			return;
		}
	}

	$reset = sendMail($email, $reset_token);
	if(!$reset) {
		$notice->addError("SMTP Error: Failed to send password reset instruction !");
		header("location:".HTTP."?page=forgot_password");
		return;
	}

	$notice->addSuccess("Check your email to reset password");
	header("location:".HTTP."?page=login");
	return;
} else {
    $notice->addError("Please, Insert correctly !");
    header("location:".HTTP."?page=login");
	return;
}