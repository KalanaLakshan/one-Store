		//document starts
		$("document").ready(function(){

			fetchAdminNotifications();

			//Fetch User Notifications
			function fetchAdminNotifications()
			{
					var action = "fetchAdminNotifications";

			        	$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action},
			            success: function(data){

			                $("#adminNotifications").html(data);

			            }

			        });
			}

			//Close Admin Notifications
			$(document).on("click",".closeNotification",function(){

				var nID = $(this).attr("data-id");
				var action = "closeNotifications";

						$.ajax({

			            url: "./assests/action.php",
			            type: "POST",
			            data: {action:action,nID:nID},
			            success: function(data){

			            	fetchUserNotifications();

			            }

			        });

			})

		})//document ends