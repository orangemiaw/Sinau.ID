<?php

defined('SINAUID') OR exit('No direct script access allowed');

class notice {
	var $error;
	
	public function error($strong,$i){
		$this->error = "<strong>{$strong}</strong>, <i>{$i}</i> !<br>";
		echo $this->error;
	}
	
	public function warning($error){
		$this->error = "$default !<br>";
		echo $this->error;
	}
	
	public function addError($text = ""){
		$_SESSION['ERROR'] = !isset($_SESSION['ERROR']) ? $text : $text.'<br/>'.$_SESSION['ERROR'];
	}
	
	public function showError(){
		if(isset($_SESSION['ERROR'])){
			$msg = trim($_SESSION['ERROR']);
			echo '<div class="alert alert-dismissable alert-danger">
                    <i class="icon-remove-sign"></i>  '.$msg.'
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  </div>';
			unset($_SESSION['ERROR']);
		}
	}
	
	public function addSuccess($text = ""){
		$_SESSION['SUCCESS'] = !isset($_SESSION['SUCCESS']) ? $text : $text.'<br/>'.$_SESSION['SUCCESS'];
	}
	
	public function showSuccess(){
		if(isset($_SESSION['SUCCESS'])){
			$msg = trim($_SESSION['SUCCESS']);
			echo '<div class="alert alert-success alert-dismissable">
                    <i class="icon-remove-sign"></i>  '.$msg.'
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  </div>';
			unset($_SESSION['SUCCESS']);
		}
	}
}
?>