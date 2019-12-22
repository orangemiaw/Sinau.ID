<?php

require_once PATH_MODEL . 'model_participant.php';

$m_participant = new model_participant($db);

if (isset($_POST['login']) && isset($_POST['passwd'])){
    $name           = $_POST['name'];
    $login          = $_POST['login'];
    $email          = $_POST['email'];
    $passwd         = $_POST['passwd'];
    $confirm_passwd = $_POST['confirm_passwd'];
    $captcha 		= $_POST['g-recaptcha-response'];

     if(RECAPTCHA_STATUS) {
		$curl 			= new curl();
          $response		     = $curl->get("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET_KEY."&response=".$captcha."&remoteip=".ip_address());
          $json_response 	= json_decode($response, true);

          if($json_response['success'] == false) {
               $notice->addError("Please, Solve the reCAPTCHA !");
               header("location:".HTTP."?page=register");
               return;
          }
     }

    $email_registered = $m_participant->get_row(array("participant_email" => $email));
    if($email_registered) {
          $notice->addError("Email already exists !");
          header("location:".HTTP."?page=register");
          return;
    }

    if($passwd != $confirm_passwd){
          $notice->addError("Passwords doesn't match !");
          header("location:".HTTP."?page=register");
          return;
     }

     $insert = $db->insert("participants", array(
          "participant_name"            => $name,
          "participant_email"           => $email,
          "participant_login"           => $login,
          "participant_password"        => encrypt_password($passwd),
          "participant_group_id"        => DEFAULT_GROUP_ID,
          "participant_forgot_status"   => FORGOT_DEACTIVE,
          "participant_status"          => STATUS_ENABLE
     ));

     if(!$insert) {
          $notice->addError("DB: Query error !");
          header("location:".HTTP."?page=login");
          return;
     }

     $notice->addSuccess("User Created Successfully !");
     header("location:".HTTP."?page=login");
     return;
} else {
     $notice->addError("Please, Insert correctly !");
     header("location:".HTTP."?page=register");
     return;
}
?>