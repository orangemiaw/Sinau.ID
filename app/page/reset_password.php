<?php
// Block direct request to source
defined('SINAUID') OR exit('No direct script access allowed');
// Check session login
if(isset($_SESSION['login'])) {
    header('Location:'.HTTP.'?page=login');
    die();
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
	<title><?=TITLE;?> - Login</title>
	<link href="<?=HTTP.'app/theme/assets/img/icon.png';?>" rel="shortcut icon">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/font-awesome/css/font-awesome.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/Ionicons/css/ionicons.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/jquery-switchbutton/jquery.switchButton.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/lib/SpinKit/spinkit.css';?>">
	<link rel="stylesheet" href="<?=HTTP.'app/theme/assets/css/bracket.css';?>">

	<script src="<?=HTTP.'app/theme/assets/lib/jquery/jquery.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/jquery-ui/jquery-ui.js';?>"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
	<script type="text/javascript">
		var request = {
			base_url : '<?=HTTP;?>',
		};
	</script>
</head>
<body>
	<div class="single-layout d-flex align-items-center justify-content-center bg-br-primary ht-100v">
    
        <form action="<?=HTTP."?do=login";?>" method="post" id="login" class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">

            <div class="signin-logo tx-center tx-30 tx-bold tx-inverse">
                <span class="tx-normal"><img src="<?=HTTP.'app/theme/assets/img/logo-main.png';?>" width="200"></span>

            </div>

            <div class="tx-center">
				<br>
                <p>A GOOD WAY TO LEARN</p>
            </div>

            <?=$notice->showSuccess();?>
            <?=$notice->showError();?>

            <div class="form-group">
                <input class="form-control" type="text" name="login" placeholder="Enter New Password">
                <ul class="field-message parsley-errors-list filled">
                </ul>
            </div>

            <div class="form-group">
                <input class="form-control" type="password" name="passwd" placeholder="Re-Enter New Password" autocomplete>
                <ul class="field-message parsley-errors-list filled">
                </ul>
            </div>


            <button class="btn btn-primary btn-block" type="submit">Reset Password <i class="ion ion-md-log-in"></i></button>
            

	    </form>

	</div>
	
	<?php

	if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
	$key = $_GET["key"];
	$email = $_GET["email"];
	$curDate = date("Y-m-d H:i:s");
	$query = mysqli_query($con,"
	SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
	$row = mysqli_num_rows($query);
	if ($row==""){
	$error .= '<h2>Invalid Link</h2>
	<p>The link is invalid/expired. Either you did not copy the correct link from the email, 
	or you have already used the key in which case it is deactivated.</p>
	<p><a href="https://www.allphptricks.com/forgot-password/index.php">Click here</a> to reset password.</p>';
		}else{
		$row = mysqli_fetch_assoc($query);
		$expDate = $row['expDate'];
		if ($expDate >= $curDate){
		?>
		
		<br />
		<form method="post" action="" name="update">
		<input type="hidden" name="action" value="update" />
		<br /><br />
		<label><strong>Enter New Password:</strong></label><br />
		<input type="password" name="pass1" id="pass1" maxlength="15" required />
		<br /><br />
		<label><strong>Re-Enter New Password:</strong></label><br />
		<input type="password" name="pass2" id="pass2" maxlength="15" required/>
		<br /><br />
		<input type="hidden" name="email" value="<?php echo $email;?>"/>
		<input type="submit" id="reset" value="Reset Password" />
		</form>
	<?php
	}else{
	$error .= "<h2>Link Expired</h2>
	<p>The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).<br /><br /></p>";
					}
			}
	if($error!=""){
		echo "<div class='error'>".$error."</div><br />";
		}			
	} // isset email key validate end


	if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
	$error="";
	$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
	$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
	$email = $_POST["email"];
	$curDate = date("Y-m-d H:i:s");
	if ($pass1!=$pass2){
			$error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
			}
		if($error!=""){
			echo "<div class='error'>".$error."</div><br />";
			}else{

	$pass1 = md5($pass1);
	mysqli_query($con,
	"UPDATE `users` SET `password`='".$pass1."', `trn_date`='".$curDate."' WHERE `email`='".$email."';");	

	mysqli_query($con,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");		
		
	echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
	<p><a href="https://www.allphptricks.com/forgot-password/login.php">Click here</a> to Login.</p></div><br />';
			}		
	}
	?>

	<script src="<?=HTTP.'app/theme/assets/lib/popper.js/popper.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/bootstrap/bootstrap.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/moment/moment.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/jquery-switchbutton/jquery.switchButton.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/peity/jquery.peity.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/lib/jquery-validation-1.17.0/dist/jquery.validate.min.js';?>"></script>
	<script src="<?=HTTP.'app/theme/assets/js/bracket.js';?>"></script>
</body>
</html>
