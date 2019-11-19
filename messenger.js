
$(document).ready(function(){
	
	setInterval(function(){
		
		fetch_users();
		
		users_online_offline_status();
		
	},1000);
	
	$(document).on('keyup','#type_message', function(){
		
		var TypeMessage = $('#type_message').val();
		
	      if(TypeMessage.length > 0){
			  
			  $('#like').hide();
			  
			  $('#send').show();
			  
		  }else{
			  
			 $('#like').show(); 
			 
			 $('#send').hide();
		  }
		 
	});
		
	$(document).on('click','#setting', function(){
		
		$('.setting-model').show();
		
	});
	
	$('body').on('click', function(){
		
		$('.setting-model').hide();
		
	});
	
	
	$(document).on('change', '#profile_image', function(){
		
		var formData = new FormData();
		
		var inputFile = document.getElementById('profile_image').files[0];
		
		 formData.append("file", inputFile);
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:formData,
			
			contentType:false,
			
			cache:false,
			
			processData:false,
			
			success:function(data){
				
			$('.profile-user-image').html(data);
			
			}
			
		});
		
	});
	
	
	fetch_users();
	
	function fetch_users()
	{
		
		var action = "fetch_users";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_users:action},
			
			success:function(data){
				
			$('.user-main-container').html(data);
			
			}
			
		});
		
	}
	
	
	
	$(document).on('click','.user-main-details', function(){
		
		var userId = $(this).data('user_id');
		
		fetch_users_top_nav(userId);
		
		fetch_users_profile(userId);
		
		type_messages(userId);
		
		fetch_message(userId); 

        users_last_seen_message(userId);
			
	});
	
	
	
	function type_messages(userId){
	
	$('#send').unbind('click').bind('click', function(){
			
		var SendMessage = $('#type_message').val();
		
		send_message(userId, SendMessage);
	   
	
	});
	
	}
	
	
	fetch_users_top_nav(userId);
	
	function fetch_users_top_nav(userId)
	{
		
		var action = "fetch_users_top_nav";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_users_nav:action, user_id:userId},
			
			success:function(data){
				
			$('.main-navbar').html(data);
			
			}
			
		});
		
	}
	
	fetch_users_profile(userId);
	
	function fetch_users_profile(userId)
	{
		
		var action = "fetch_users_profile";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_users_profile:action, user_id:userId},
			
			success:function(data){
				
			$('.user-profile-detail').html(data);
			
			}
			
		});
		
	}
	
	
	  
	send_message(userId, SendMessage);
	
	function send_message(userId, SendMessage)
	{
		
		var action = "send_message";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_send_message:action, user_id:userId, send_message:SendMessage},
			
			success:function(data){
				
			$('#type_message').val('');	
				  
			fetch_message(userId);
			
			
			}
			
		});
		
	}
	
	
	
	   fetch_message(userId);
	
	  function fetch_message(userId)
	  {
		
		var action = "fetch_message";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_fetch_message:action, user_id:userId},
			
			success:function(data){
				
			$('.chat-chat-container').html(data);	
				  
			
			}
			
		});
		
	}
	
	
	 users_last_seen_message(userId);
	
	  function users_last_seen_message(userId)
	  {
		
		var action = "users_last_seen_message";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_users_last_seen_message:action, user_id:userId},
			
			success:function(data){
				
			 //alert(data);	  
			
			}
			
		});
		
	}
	
	users_online_offline_status();
	
	  function users_online_offline_status()
	  {
		
		var action = "users_online_offline_status";
		
		$.ajax({
			
			url:"messenger_action.php",
			
			method:"post",
			
			data:{action_status:action},
			
			success:function(data){
				
			 //alert(data);	  
			
			}
			
		});
		
	}
	
	
});