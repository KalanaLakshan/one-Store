	
	$("document").ready(function(){

		//Sign Up
		$("#signUpBtn").on("click",function(event){
			event.preventDefault();

			//getting and storing in variables
			var orgName = $("#orgName").val();
			var username = $("#username").val();
			var email = $("#email").val();
			var phone = $("#phone").val();
			var password = $("#password").val();
			var cPassword = $("#cPassword").val();

			//assigning false condition for all variables
			var orgName_Status = false;
			var username_Status = false;
			var email_Status = false;
			var phone_Status = false;
			var password_Status = false;
			var cPassword_Status = false;

			//orgName must be greater than 5 characters
			if(orgName == "" || orgName.length<6)
			{
				$(".orgName_error").html("*Organization Name Must be Grater than Five Characters");
			}
			else
			{
				orgName_Status = true;
				$(".orgName_error").html("");
			}

			//username must be greater than 5 characters
			if(username == "" || username.length<6)
			{
				$(".username_error").html("*Username Must be Grater than Five Characters");
			}
			else
			{
				username_Status = true;
				$(".username_error").html("");
			}

			//Email must be valid
			if(!/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email))
			{
				$(".email_error").html("*Email must be valid");
			}
			else
			{
				email_Status = true;
				$(".email_error").html("");
			}

			//Phone number must be 10 numbers
			if(phone == "" || phone.length !=10)
			{
				$(".phone_error").html("*Phone number must be 10 Numbers");
			}
			else
			{
				phone_Status = true;
				$(".phone_error").html("");
			}

			//Password must be greater than 7 characters
			if(password == "" || password.length<8)
			{
				$(".password_error").html("*Password must be grater than 7 characters");
			}
			else
			{
				password_Status = true;
				$(".password_error").html("");
			}

			//Confirm password must be same as password
			if(cPassword != password)
			{
				$(".cPassword_error").html("*Confirm password must be same as password");
			}
			else
			{
				cPassword_Status = true;
				$(".cPassword_error").html("");
			}

			//If all conditions true 
			if(orgName_Status == true && username_Status == true && email_Status == true && phone_Status == true && password_Status == true && cPassword_Status == true)
			{
				$.ajax({
					url: "./assests/action.php",
					type: "POST",
					data: $("#signUp-form").serialize()+'&action=signUp',
					success: function(data)
					{
						if($.trim(data) == "Success")
						{
							$("#successStatement").removeClass("bg-danger");
							$("#successStatement").addClass("bg-success");
							$("#successStatement").html("<h4>Sign Up Success</h4> <a href='http://localhost/One_Store/login.php' class='text-light'> Click to Login </a>");
							document.getElementById("signUp-form").reset();
						}
						else if($.trim(data) == "Exists")
						{
							$("#successStatement").addClass("bg-danger");
							$("#successStatement").html("<h4>Organization Name Already Exists</h4>");
						}
						else
						{
							alert(data);
						}
					}
				})
			}//If all conditions true ends

	

		})

	})