    	
		//document starts
		$("document").ready(function(){

			//Change Password Starts
			$("#changeUserPasswordBtn").on("click",function(e){

				e.preventDefault();

				var userOldPassword = $("#userOldPassword").val();
				var userNewPassword = $("#userNewPassword").val();	
				var orgName = $("#orgName").val();

				var userOldPassword_Status = false;
				var userNewPassword_Status = false;

				if(userOldPassword == "")
		    	{
		    		$(".userOldPasswordError").html("*Please Enter the Old Password");
		    	}
		    	else
		    	{
		    		$(".userOldPasswordError").html("");
		    		userOldPassword_Status = true;
		    	}

			    if(userNewPassword == "" || userNewPassword.length<8)
				{
					$(".userNewPasswordError").html("*Password must be grater than 7 characters");
				}
				else
				{
					userNewPassword_Status = true;
					$(".userNewPasswordError").html("");
				}

				//If all conditions true 
				if(userOldPassword_Status == true && userNewPassword_Status == true)
				{
					$.ajax({
						url: "./assests/action.php",
						type: "POST",
						data: { userOldPassword:userOldPassword, userNewPassword:userNewPassword, orgName:orgName, action: 'changeUserPassword'},
						success: function(data)
						{
							if($.trim(data) == "Success")
							{
								document.getElementById("changeUserPasswordForm").reset();
								$("#changeUserPasswordError").html("Password Changed Successfully");
								$("#changeUserPasswordError").removeClass("bg-danger");
								$("#changeUserPasswordError").addClass("bg-success");
							}
							else
							{
								$("#changeUserPasswordError").html("Old Password is Not Matching");
								$("#changeUserPasswordError").removeClass("bg-success");
								$("#changeUserPasswordError").addClass("bg-danger");
							}

						}
					})
				}//If all conditions true ends

			})//Change Password Ends

			//Change Details Starts
			$("#changeSettingsBtn").on("click",function(e){

				e.preventDefault();

				var orgName = $("#orgName").val();
				var email = $("#emailEdit").val();
				var phone = $("#phoneEdit").val();
				var regDate = $("#regDateEdit").val();
				var bRegNo = $("#bRegNoEdit").val();
				var country = $("#countryEdit").val();
				var city = $("#cityEdit").val();
				var province = $("#provinceEdit").val();

				var emailStatus = false;
				var phoneStatus = false;

				//Email must be valid
				if(!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email))
				{
					$(".editEmail_error").html("*Email must be valid");
				}
				else
				{
					emailStatus = true;
					$(".editEmail_error").html("");
				}

				//Phone number must be 10 numbers
				if(phone == "" || (phone.length <9 || phone.length>10) )
				{
					$(".editPhone_error").html("*Phone number must be 10 Numbers");
				}
				else
				{
					phoneStatus = true;
					$(".editPhone_error").html("");
				}

				if(phoneStatus == true && emailStatus == true)
				{
						$.ajax({
						url: "./assests/action.php",
						type: "POST",
						data: { email:email,orgName:orgName,phone:phone, regDate:regDate, bRegNo:bRegNo, country:country, city:city, province:province, action: 'changeDetails'},
						success: function(data)
						{
							if($.trim(data) == "Success")
							{
								$("#changeUserDetailsMsg").html("Details Changed Successfully");
								$("#changeUserDetailsMsg").removeClass("bg-danger");
								$("#changeUserDetailsMsg").addClass("bg-success");
							}
							else
							{

							}

						}
					})
				}



			})//Change Details Ends

		})//document ends

