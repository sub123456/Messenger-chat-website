<?php
 
  error_reporting(0);
  
  include('messenger_connect.php');
  
  session_start();
  
  
  if(isset($_POST['submit'])){
	  
	  $email = $_POST['email'];
	  
	  $password = $_POST['password'];
	  
	  
	  if(empty($email)|| empty($password)){
		  
		  
		$message = "<h6>"."Plss fill all fields"."</h6>";  
		  
	  }else{
		  
		  
		  $sql = "SELECT * FROM `user` WHERE `email`= '$email' AND `password`= '$password'";
		  
		  $result = mysqli_query($conn, $sql);
		  
		  if(mysqli_num_rows($result)>0){
			  
			   while( $row = mysqli_fetch_assoc($result)){
				  
				 $_SESSION['user_id'] = $row['user_id'];
				 
				 $_SESSION['user_name'] = $row['user_name'];
				 
				 header('location:messenger.php');
				 
				 $message = "<h6>"."Sign In successfully.."."</h6>";		  
			
			}
			    
		  }else{
			  
			 
		      $message = "<h6>"."Email and Password doesn't match"."</h6>";  
			
		  
		  }
		  
		  
	  }
	  
	  
  }


?>


<!DOCTYPE html>
<html>
<head>

 <title>Messenger Website Sign In</title>
 
 <meta charset="utf-8">
  
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <!----add jquery link----> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
 <style>
 *{
	 margin:0;
	 padding:0;
	 box-sizing:border:box;
 }
 .container{
	 
	 width:100%;
	 height:100%;
 }
 .top-navbar{
	 
	 width:100%;
	 height:80px;
	 border-bottom:1px solid #ccc;
 }
 .top-nav{
	 
	 float:left;
 }
 .top-nav.logo{
	 
	 width:80%
 }
 .top-nav.name{
	 
	 width:10%
 }
 .top-nav-image{
	 
	 width:50px;
	 height:50px;
	 margin-top:10px;
	 margin-left:200px;
 }
 .top-nav-image img{
	 
	 width:100%;
	 height:100%;
 }
 .top-nav p{
	 
	 margin-top:25px;
	 font-size:18px;
	 color:#aaa;
 }
 .signup-main-container{
	 
	 width:100%;
 }
 .signup-container{
	 
	 float:left;
 }
 .signup-container.signup{
	 
	 width:50%;
 }
 .signup-container.logo{
	 
	 width:50%;
 }
 .signup-container-inside{
	 
	 width:80%;
	 margin:auto;
	 height:400px;
	 margin-top:100px;
 }
 .signup-heading p{
	 
	 font-size:25px;
	 text-align:start;
	 margin-left:100px;
	 margin-top:10px;
 }
 .signup-subheading p{
	 
	 font-size:20px;
	 text-align:start;
	 margin-left:100px;
	 margin-top:10px;
	 margin-bottom:10px;
	 color:#aaa;
 }
  input[type=email], [type=password]{
	 
	 font-size:16px;
	 width:50%;
	 padding:5px;
	 margin-left:100px;
	 margin-top:10px;
	 border:none;
	 border-radius:5px;
	 background-color:#eee;

 }
 .signup-email{
	 
	 width:100%;
	 
 }
 button{
	 
	 margin-left:100px;
	 margin-top:10px;
	 font-size:16px;
	 border:none;
	 border-radius:10px;
	 background-color:#0084ff;
	 color:white;
	 padding:8px;
 }
 .signup-account{
	 
	 margin-left:100px;
	 margin-top:20px;
	 font-size:20px;
 }
 .signup-account a{
   
   color:#0084ff;
   text-decoration:none;
 }
 .signup-container img{
	 
	 width:80%;
	 margin-top:10px;
 }
 h6{
	 
	 font-size:16px;
	 color:red;
	 margin-left:100px;
 }
 </style>
 </head>
 <body>
 
  <div class="container">
  
      <div class="top-navbar">
         
		  <div class="top-nav logo">
           
		      <div class="top-nav-image">
  
                <img src="icon/messenger.png" />
			
              </div>
		  
		  </div>
		  
		  <div class="top-nav name">
  
             <p><b>Features</b></p>
			 
          </div>
		  
		  <div class="top-nav name">
  
             <p><b>For Developers</b></p>
			 
          </div>
  
      </div>
	  
	  <div class="signup-main-container">
	  
	  <div class="signup-container signup">
	      
		   <div class="signup-container-inside">
		   
	          <form action="" method="post" />
	    
	             <div class="signup-heading">
	    
	                <p><b>Be together,</br> whenever.</b></p>
					
	             </div>
				 
				 <div class="signup-subheading">
	    
	                <p>A simple way to text, video chat and </br> plan things all in one place.</p>
					
	             </div>
				 
				  <?php
				 
				  echo $message ;
				 
				 ?>
				 
				 <div class="signup-email">
	    
				 <input type="email" name="email" placeholder="Email address or Phone number" />
				 
				 </div>
				 
				 <div class="signup-password">
				
                 <input type="password" name="password" placeholder="Password" />
				 
				 </div>
				 
				 <div class="signup-button">
				
				 
				 <button type="submit" name="submit">Sign In</button>
				 
				 </div>
				 
				  </form>
				 
				 <div class="signup-account">
				
				 
				 <p>Don't Have an account? <a href="messenger_signup.php">Sign Up</a> </p>
				 
				 </div>
								
	       </div>
	   
	  </div>
	  
	   <div class="signup-container logo">
	  
	     <img src="icon/logo.jpg" />
		 
	   </div>
	  
	 </div>
  
  </div>
 
 <script>
 
</script>
    
</body>
</html> 