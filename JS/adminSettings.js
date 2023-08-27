		//document starts
		$("document").ready(function(){

			
			$("#changePasswordBtn").on("click",function(e){

				e.preventDefault();

				var oldPassword = $("#oldPassword").val();
				var newPassword = $("#newPassword").val();	
				var username = $("#adminUsername").val();

				var oldPassword_Status = false;
				var newPassword_Status = false;

				if(oldPassword == "")
		    	{
		    		$(".oldPasswordError").html("*Please Enter the Old Password");
		    	}
		    	else
		    	{
		    		$(".oldPasswordError").html("");
		    		oldPassword_Status = true;
		    	}

			    if(newPassword == "" || newPassword.length<8)
				{
					$(".newPasswordError").html("*Password must be grater than 7 characters");
				}
				else
				{
					newPassword_Status = true;
					$(".newPasswordError").html("");
				}

				//If all conditions true 
				if(oldPassword_Status == true && newPassword_Status == true)
				{
					$.ajax({
						url: "./assests/action.php",
						type: "POST",
						data: { oldPassword:oldPassword, newPassword:newPassword, username:username, action: 'changeAdminPassword'},
						success: function(data)
						{
							if($.trim(data) == "Success")
							{
								document.getElementById("changePasswordForm").reset();
								$("#changePasswordError").html("Password Changed Successfully");
								$("#changePasswordError").removeClass("bg-danger");
								$("#changePasswordError").addClass("bg-success");
							}
							else
							{
								$("#changePasswordError").html("Old Password is Not Matching");
								$("#changePasswordError").removeClass("bg-success");
								$("#changePasswordError").addClass("bg-danger");
							}
						}
					})
				}//If all conditions true ends

			})

		})//document ends