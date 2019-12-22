<?php defined('SINAUID') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en" class="pos-relative">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>404 Not Found!</title>
	<link href="<?=HTTP;?>app/theme/assets/img/icon.png" rel="shortcut icon">

	<!-- vendor css -->
	<link href="<?=HTTP;?>app/theme/assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?=HTTP;?>app/theme/assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">

	<!-- Bracket CSS -->
	<link rel="stylesheet" href="<?=HTTP;?>app/theme/assets/css/bracket.css">
</head>

<body class="pos-relative">

	<div class="ht-100v d-flex align-items-center justify-content-center">
		<div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
			<h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">404!</h1>
			<h5 class="tx-xs-24 tx-normal tx-primary mg-b-30 lh-5">The page your are looking for has not been found.</h5>
			<p class="tx-16 mg-b-30">The page you are looking for might have been removed, had its name changed,
			or unavailable.</p>
			<div class="tx-inverse tx-24 mg-b-15 align-middle">
				<i class="fa fa-linux fa-3x fa-flip-horizontal"></i>
				<a href="<?=HTTP;?>" class="btn btn-primary btn-lg mg-x-20"><i class="icon ion-ios-home-outline" aria-hidden="true"></i> Let's Back Home</a>
				<i class="fa fa-linux fa-3x"></i>
			</div>

		</div>
	</div><!-- ht-100v -->

	<script src="<?=HTTP;?>app/theme/assets/lib/jquery/jquery.js"></script>
	<script src="<?=HTTP;?>app/theme/assets/lib/popper.js/popper.js"></script>
	<script src="<?=HTTP;?>app/theme/assets/lib/bootstrap/bootstrap.js"></script>

</body>
</html>
