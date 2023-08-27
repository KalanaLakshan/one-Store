    	
		//document starts
		$("document").ready(function(){

			setNotificationAlert();			

			//Set Notification Alert
			function setNotificationAlert()
			{
				var orgID = $("#orgID").val();
				var action = "setNotificationAlert";

				$("#notificationCount").html("");

					$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,orgID:orgID},
			            success: function(data){

			            		if($.trim(data) == 1)
								{
									$("#notificationCount").html("New");
									$("#notificationCount").show();
								}
								else
								{
									$("#notificationCount").html("");
									$("#notificationCount").hide();
								}

			            }

			        });

			}		

		})//document ends

