<?php
session_start();
if(isset($_GET['captcha_code']))
{
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_GET['captcha_code']) != 0){  
		echo "0";	
	}else{		
		echo "1";		
	}
}
?>