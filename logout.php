<?php 
    include 'class.session.inc.php'; Session::init();	
	
    Session::logout();
    header('Location: login.php');
?>
