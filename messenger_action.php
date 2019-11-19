<?php
 
  error_reporting(0);
  
  include('messenger_connect.php');
  
  session_start();
  
  
  if($_FILES['file']['name'] != ''){
	  
	$userId = $_SESSION['user_id'];

	$target_dir = "profileImage/";
	  
    $name  = $_FILES['file']['name'] ;
	
	$target_file_name = $target_dir . basename($name);
	
	$image_url = "http://localhost/chat/profileImage/".$name ; 
		
	move_uploaded_file($_FILES['file']['tmp_name'], $target_file_name);
	
	$sql = "UPDATE `user` SET `user_image`='$image_url' WHERE `user_id`='$userId'" ;
	
	$result = mysqli_query($conn, $sql);
	
	if($result){
		
		$query = "SELECT * FROM `user` WHERE `user_id`='$userId'" ;
	
	    $query_result = mysqli_query($conn, $query);
	
		while($row = mysqli_fetch_assoc($query_result)){
			
			$userImage = $row['user_image'];
			
			
			if($userImage == null){
				
				$user_image = "<img src='icon/user.png'/>";
				
			}else{
				
				$user_image = "<img src='$userImage'/>";
			}
			
			echo $user_image ;
		}
	}
	
	  
  }
  
  
  //fetch users
  
  if(isset($_POST['action_users'])){
	  
	  $userId = $_SESSION['user_id'];
	  
	  $query = "SELECT * FROM `user` WHERE `user_id` != '$userId'" ;
	
	    $query_result = mysqli_query($conn, $query);
	
		while($row = mysqli_fetch_assoc($query_result)){
			
			$userImage = $row['user_image'];
			
			$userName = $row['user_name'];
			
			$userId = $row['user_id'];
			
			if($userImage == null){
				
				$user_image = "<img src='icon/user.png'/>";
				
			}else{
				
				$user_image = "<img src='$userImage'/>";
			}
			
			echo " <div class='user-main-details' data-user_id='".$userId."'>
			
			<div class='user-main-container-inside'>
		  
		                 <div class='user-main-inside photo'>
		  
		                     <div class='user-main-image'>
		  
		                        $user_image
		 
		                     </div>
		 
		                 </div>
						 
						 <div class='user-main-inside text'>
		  
		                        <div class='user-main-name'>
		  
		                          <p>$userName</p>
								  
		                        </div>
								
								<div class='user-main-message'>
								
								 ".make_user_last_seen_message($conn, $userId)."
		                       
		                        </div>
							  
		                 </div>
		            
					  </div>
					  
					  </div>
					  
					  </div>" ;
		}
  }
  
  function make_user_last_seen_message($conn, $userId){
	  
	   $senderId = $_SESSION['user_id'];
	  
	   $receiverId = $userId;
	 
	   $query = "SELECT * FROM `user_chat` WHERE (`sender_id` = '$senderId' AND `receiver_id` = '$receiverId')
	   
	    OR (`sender_id` = '$receiverId' AND `receiver_id` = '$senderId') 
		
		ORDER BY user_id DESC LIMIT 1" ;
	
	   $result = mysqli_query($conn, $query);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		   $userMessage = $row['message'];
		   
		   $date = $row['date'];
		   
		   $lastSeen = $row['chat_status'];
		   
		   $time = date('D d', STRTOTIME($date));
		   
		   if($lastSeen == 0){
		   
		   $output = '<div class="user-last-message message">
		  
		                             <p>'.$userMessage.'</p>
									 
		                            </div>
									
									<div class="user-last-message date">
		                            
									 <p>'.$time.'</p>
		                       
		                            </div>';
		   }else{
			   
			    $output = '<div class="user-last-message message">
		  
		                             <p>You:'.$userMessage.'</p>
									 
		                            </div>
									
									<div class="user-last-message date">
		                            
									 <p>'.$time.'</p>
		                       
		                            </div>';
		
		   }
	   }
	   
	   return $output;
  }
  
  if(isset($_POST['action_users_nav'])){
	  
	   $userId = $_POST['user_id'];
	  
	  $query = "SELECT * FROM `user` WHERE `user_id` = '$userId'" ;
	
	    $query_result = mysqli_query($conn, $query);
	
		while($row = mysqli_fetch_assoc($query_result)){
			
			$userImage = $row['user_image'];
			
			$userName = $row['user_name'];
			
			$date = $row['date'];
			
			
			if($userImage == null){
				
				$user_image = "<img src='icon/user.png'/>";
				
			}else{
				
				$user_image = "<img src='$userImage'/>";
			}
			
		echo " <div class='main-navbar-inside photo'>
            
			           <div class='navbar-image'>
            
			            $user_image
   
                       </div>
   
                  </div> 
				  
				  <div class='main-navbar-inside name'>
            
			             <div class='navbar-name'>
            
			              <p><b>$userName</b></p>
   
                         </div> 
						 
						 <div class='navbar-time'>
            
			              ".make_status($conn, $date)."
   
                         </div> 
   
                  </div> 
				  
				  <div class='main-navbar-inside icon'>
            
			          <div class='navbar-icon'>
            
			            <img src='icon/call.png' />
   
                       </div>
   
                  </div> 
				  
				  <div class='main-navbar-inside icon'>
            
			          <div class='navbar-icon'>
            
			            <img src='icon/video_call.png' />
   
                       </div>
   
                  </div>
				  
				  <div class='main-navbar-inside icon'>
            
			           <div class='navbar-icon'>
            
			            <img src='icon/information.png' />
   
                       </div>
   
                  </div> ";	
			
		}
		
  }
  

  
  if(isset($_POST['action_users_profile'])){
	  
	   $userId = $_POST['user_id'];
	  
	   $query = "SELECT * FROM `user` WHERE `user_id` = '$userId'" ;
	
	   $query_result = mysqli_query($conn, $query);
	
		while($row = mysqli_fetch_assoc($query_result)){
			
			$userImage = $row['user_image'];
			
			$userName = $row['user_name'];
			
			$date = $row['date'];
			
			if($userImage == null){
				
				$user_image = "<img src='icon/user.png'/>";
				
			}else{
				
				$user_image = "<img src='$userImage'/>";
			}
			
		echo " <div class='user-profile-image'>
					           
			       $user_image
							   
				 </div>
							 
			    <div class='user-profile-name'>
					  
				 <p><b>$userName</b></p>
								 
				 </div>
							 
				 <div class='user-profile-time'>
					  
				    ".make_status($conn, $date)."
								
				 </div>";
		
		}
  }
  
  function make_status($conn, $status){
	  
	  date_default_timezone_set('Asia/kolkata');
	  
	  $current_timeStamp = STRTOTIME(date("Y-m-d H:i:s"). '-10 second');
	  
	  $current_time = date("Y-m-d H:i:s", $current_timeStamp);
	  
	       if($status > $current_time){
				
				$output = '<p>online</p>';
				
			}else{
				
				$output = '<p>'.make_status_time($status).'</p>';
			}
			
		
		return $output;
	  
  }
 
  
  function make_status_time($time_ago){
	  
	  $time_ago = STRTOTIME($time_ago);
	  
	  $current_time = time();
	  
	  $time_diff = $current_time - $time_ago;
	  
	  $seconds = $time_diff;
	  
	  $mins = round($time_diff/60);
	  
	  $hours = round($time_diff/3600);
	  
	  $days = round($time_diff/86400);
	  
	  $weeks = round($time_diff/604800);
	  
	  $months = round($time_diff/2600640);
	  
	  $years = round($time_diff/31207680);
	  
	  if($seconds <= 60){
		  
		  return "1s ago";
	  }
	  else if($mins <= 60){
		  
		  if($mins == 1){
			  
			 return "1m ago";
			 
		  }else{
			  
			  return "$mins m ago";
		  }
	  }
	  else if($hours <= 24){
		  
		  if($hours == 1){
			  
			 return "1h ago";
			 
		  }else{
			  
			  return "$hours h ago";
		  }
	  }
	  else if($days <= 7){
		  
		  if($days == 1){
			  
			 return "1d ago";
			 
		  }else{
			  
			  return "$days d ago";
		  }
	  }
	  else if($weeks <= 4.3){
		  
		  if($weeks == 1){
			  
			 return "1w ago";
			 
		  }else{
			  
			  return "$weeks w ago";
		  }
	  } 
	  else if($months <= 12){
		  
		  if($months == 1){
			  
			 return "1m ago";
			 
		  }else{
			  
			  return "$months m ago";
		  }
	  }
	  else {
		  
		  if($years == 1){
			  
			 return "1y ago";
			 
		  }else{
			  
			  return "$years y ago";
		  }
	  }
  }
  
  if(isset($_POST['action_send_message'])){
	  
	   $senderId = $_SESSION['user_id'];
	  
	   $receiverId = $_POST['user_id'];
	
	   $senderMessage = $_POST['send_message'];
	   
	   $query = "INSERT INTO `user_chat`(`sender_id`, `receiver_id`, `message`,`chat_status`) VALUES 
	   
	   ('$senderId','$receiverId','$senderMessage','1')" ;
	
	   $result = mysqli_query($conn, $query);
	   
	   if($result){
		   
		  
	   }
	
	
  }
  
  
   if(isset($_POST['action_fetch_message'])){
	  
	   $senderId = $_SESSION['user_id'];
	  
	   $receiverId = $_POST['user_id'];
	 
	   $query = "SELECT * FROM `user_chat` WHERE (`sender_id` = '$senderId' AND `receiver_id` = '$receiverId')
	   
	    OR (`sender_id` = '$receiverId' AND `receiver_id` = '$senderId')" ;
	
	   $result = mysqli_query($conn, $query);
	   
	   while($row = mysqli_fetch_assoc($result)){
		   
		   $userMessage = $row['message'];
		   
		   $sendId = $row['sender_id'];
		   
		   $userImage = $row['user_image'];
		   
           $chatStatus = $row['chat_status'];
		   
		   if($chatStatus == 1){
		   		   
		   if($senderId == $sendId){
		   
		   echo "<div class='chat-chat-right'>
						  
						     <div class='chat-right-page image'>
						  
						          <div class='chat-display-image'>
						  
						          <img src='icon/check.png' />
								  
						         </div>
								 
						      </div>
						      
							  <div class='chat-right-page name'>
						        
								   <div class='chat-display-name'>
						        
								    <p>$userMessage</p>
						     
						           </div>
						     
						      </div>
							  
						  </div>";
						  
		   }else{
			   
			  echo "<div class='chat-left'>
						  
				    <div class='chat-left-page image'>
						  
				       <div class='chat-left-display-image'>
						   
						 ". make_chat_user_image($conn, $receiverId)."
						  
						 </div>
								 
				     </div>
						  
				      <div class='chat-left-page name'>
						        
					   <div class='chat-left-display-name'>
						        
						  <p>$userMessage </p>
						     
						    </div>
						     
					  </div>
						  
						  
				  </div>"; 
			   
		   }
		   
		  }else{
			  
			 if($senderId == $sendId){
		   
		   echo "<div class='chat-chat-right'>
						  
						     <div class='chat-right-page image'>
						  
						          <div class='chat-display-image'>
						  
						         ".make_chat_last_seen_message($conn, $receiverId)."
								 
						         </div>
								 
						      </div>
						      
							  <div class='chat-right-page name'>
						        
								   <div class='chat-display-name'>
						        
								    <p>$userMessage</p>
						     
						           </div>
						     
						      </div>
							  
						  </div>";
						  
		   }else{
			   
			  echo "<div class='chat-left'>
						  
				    <div class='chat-left-page image'>
						  
				       <div class='chat-left-display-image'>
						   
						 ". make_chat_user_image($conn, $receiverId)."
						  
						 </div>
								 
				     </div>
						  
				      <div class='chat-left-page name'>
						        
					   <div class='chat-left-display-name'>
						        
						  <p>$userMessage </p>
						     
						    </div>
						     
					  </div>
						  
						  
				  </div>"; 
			   
		   } 
			  
		  }
		   	   
		      
	   }
	   
   }
   
   
   function make_chat_user_image($conn, $receiverId){
	   
	    $query = "SELECT * FROM `user` WHERE `user_id` = '$receiverId'" ;
	
	    $query_result = mysqli_query($conn, $query);
	
		while($row = mysqli_fetch_assoc($query_result)){
			
			$userImage = $row['user_image'];
			
			if($userImage == null){
				
				$output = '<img src="icon/user.png"/>';
				
			}else{
				
				$output = '<img src="'.$userImage.'"/>';
			}
			
		}
		
		return $output;
	   
   }
   
   
   function make_chat_last_seen_message($conn, $receiverId){
	   
	    $query = "SELECT * FROM `user_chat` INNER JOIN `user` ON user_chat.user_id = user.user_id
		
		WHERE user_chat.user_id = '$receiverId'" ;
	
	    $query_result = mysqli_query($conn, $query);
	
		while($row = mysqli_fetch_assoc($query_result)){
			
			$userImage = $row['user_image'];
			
			if($userImage == null){
				
				$output = '<img src="icon/user.png"/>';
				
			}else{
				
				$output = '<img src="'.$userImage.'"/>';
			}
			
		}
		
		return $output;
	   
   }
   
   
    if(isset($_POST['action_users_last_seen_message'])){
	  
	   $senderId = $_SESSION['user_id'];
	  
	   $receiverId = $_POST['user_id'];
	 
	   $query = "UPDATE `user_chat` SET `chat_status`='0' WHERE 
	   
	   (`sender_id` = '$receiverId' AND `receiver_id` = '$senderId' AND `chat_status` = '1')" ;
	
	   $result = mysqli_query($conn, $query);
	   
	   
	   if($result){
		   
		  echo "update last seen"; 
	   }
	 
	 
	}
	
	
	 if(isset($_POST['action_status'])){
	  
	   $userId = $_SESSION['user_id'];
	  
	   $query = "UPDATE `user` SET `date` = now() WHERE `user_id` = '$userId'" ;
	
	   $result = mysqli_query($conn, $query);
	   
	   
	   if($result){
		   
		  echo "update "; 
	   }
	 
	 
	}
	 
  
  ?>