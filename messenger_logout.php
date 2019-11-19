<?php
 
  error_reporting(0);
  
  include('messenger_connect.php');
  
  session_start();
  
  session_unset();
  
  header('location:messenger_signin.php');
	
 
 
 ?>