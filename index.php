<?php
ob_start();
include "core.php";
$path = ROOT."app/page/";
if(isset($_GET['page']) && !empty($_GET['page'])){
	if(file_exists($path.$_GET['page'].".php")){
		require_once $path.$_GET['page'].".php";
	} else {
		require_once $path."error/404.php";
	}
} elseif(isset($_GET['do']) && !empty($_GET['do'])){
	if(file_exists($path."request/".$_GET['do'].".php")){
		require_once $path."request/".$_GET['do'].".php";
	} else {
		require_once $path."error/404.php";
	}
} elseif(isset($_GET['add']) && !empty($_GET['add'])){
	if(file_exists($path."form/add/".$_GET['add'].".php")){
		require_once $path."form/add/".$_GET['add'].".php";
	} else {
		require_once $path."error/404.php";
	}
} elseif(isset($_GET['update']) && !empty($_GET['update'])){
	if(file_exists($path."form/update/".$_GET['update'].".php")){
		require_once $path."form/update/".$_GET['update'].".php";
	} else {
		require_once $path."error/404.php";
	}
} elseif(isset($_GET['detail']) && !empty($_GET['detail'])){
	if(file_exists($path."form/detail/".$_GET['detail'].".php")){
		require_once $path."form/detail/".$_GET['detail'].".php";
	} else {
		require_once $path."error/404.php";
	}
} elseif(isset($_GET['merchant']) && !empty($_GET['merchant'])){
	if(file_exists($path."merchant/".$_GET['merchant'].".php")){
		require_once $path."merchant/".$_GET['merchant'].".php";
	} else {
		require_once $path."error/404.php";
	}
} else {
	require_once $path."home.php";
}
ob_flush(); 
?>