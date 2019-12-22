<?php

defined('SINAUID') OR exit('No direct script access allowed');

class pagination {
	var $tabel = "";
	var $batas = "";
	var $posisi = "";
	var $halaman = "";
	public function __construct($batas){
		$this->batas = $batas;
	}
	
	public function page(){
		if(isset($_GET['page'])){
			$this->halaman = (int) $_GET['page']; 
		} else {
			$this->halaman = 0; 
		}
		if(empty($this->halaman)){ 
			$this->posisi=0; 
			$this->halaman=1; 
		} else { 
			$this->posisi = ($this->halaman-1) * $this->batas; 
		}
	}
	
	public function pagination($jum,$link){
		$jmldata= $jum; 
		$jmlhalaman=ceil($jmldata/$this->batas); 
		for($i=1;$i<=$jmlhalaman;$i++){
			if($i != $this->halaman){ 
				echo "<li class=\"active\"><a href=\"{$link}&hal={$i}\">{$i}</a></li>";
			} else {
				echo "<li class=\"disable\"><a>{$i}</a></li>";
			}
		}
	}
	
	
}