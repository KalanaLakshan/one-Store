    	
		//document starts
		$("document").ready(function(){

			setAdminNotificationAlert();			

			//Set Notification Alert
			function setAdminNotificationAlert()
			{
				var action = "setAdminNotificationAlert";

				$("#adminNotificationCount").html("");

					$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action},
			            success: function(data){

			            		if($.trim(data) == 1)
								{
									$("#adminNotificationCount").html("New");
									$("#adminNotificationCount").show();
								}
								else
								{
									$("#adminNotificationCount").html("");
									$("#adminNotificationCount").hide();
								}

			            }

			        });

			}		

		})//document ends

