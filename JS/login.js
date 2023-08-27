    	
		//document starts
		$("document").ready(function(){

				//At the starting User Login Page will be displayed
				$("#adminLogin").hide();
		    	$("#userLogin").show();

				//to go to Admin Login Page
		    	$("#gotoAdminLogin").on("click",function(){

		    		$("#userLogin").hide();
		    		$("#adminLogin").show();

		    	})//to go to Admin Login Page ends

		    	//to go to User Login Page
		    	$("#gotoUserLogin").on("click",function(){

		    		$("#adminLogin").hide();
		    		$("#userLogin").show();

		    	})//to go to User Login Page ends


		    	//User Login Starts
		    	$("#userLoginBtn").on("click",function(event){
		    		event.preventDefault();

		    		var orgName = $("#orgName").val();
		    		var userPassword = $("#userPassword").val();

		    		var orgName_Status = false;
		    		var userPassword_Status = false;

		    		//Organization Name validation
		    		if(orgName == "")
		    		{
		    			$(".orgName_error").html("*Please Enter the Organization Name");
		    		}
		    		else
		    		{
		    			$(".orgName_error").html("");
		    			orgName_Status = true;
		    		}

		    		//Password Validation
		    		if(userPassword == "")
		    		{
		    			$(".userPassword_error").html("*Please Enter the Password");
		    		}
		    		else
		    		{
		    			$(".userPassword_error").html("");
		    			userPassword_Status = true;
		    		}

		    		//Ajax Request for User Login Starts
		    		if(orgName_Status == true && userPassword_Status==true)
		    		{
		    			$.ajax({
		    			url: "./assests/action.php",
		    			type: "POST",
		    			data: $("#userLoginForm").serialize()+'&action=userLogin',
		    			success: function(data)
		    			{
		    				if($.trim(data) == "matching")
		    				{
		    					window.location = "dashboard.php";
		    				}
		    				else if($.trim(data) == "notMatching")
		    				{
		    					$("#userLogError").html("<h4>Invalid Password</h4>");
		    				}
		    				else if($.trim(data) == "notAvailable")
		    				{
		    					$("#userLogError").html("<h4>Organization Name Not Available</h4>");
		    				}
		    				else
		    				{
		    					alert(data);
		    				}
		    			}

		    		})
		    		}//Ajax Request for User Login Ends

		    })//User Login Ends


		    	//Admin Login Starts
		    	$("#adminLoginBtn").on("click",function(event){
		    		//event.preventDefault();

		    		var username = $("#username").val();
		    		var adminPassword = $("#adminPassword").val();

		    		var username_Status = false;
		    		var adminPassword_Status = false;

					if(username == "")
					{
						$(".username_error").html("*Please Enter the Username");
					}
					else
					{
						$(".username_error").html("");
						username_Status = true;
					}

					if(adminPassword == "")
					{
						$(".adminPassword_error").html("*Please Enter the Password");
					}
					else
					{
						$(".adminPassword_error").html("");
						adminPassword_Status = true;
					}

					//Ajax Request for Admin Login Ends
					if(username_Status == true && adminPassword_Status == true)
					{
						$.ajax({
							url: "./assests/action.php",
		    				type: "POST",
		    				data: $("#adminLoginForm").serialize()+'&action=adminLogin',
		    				success: function(data)
		    				{
		    					if($.trim(data) == "adminMatching")
		    					{
		    						window.location = "adminHome.php";
		    					}
		    					else if($.trim(data) == "adminNotMatching")
		    					{
		    						$("#adminLogError").html("<h4>Invalid Password</h4>");
		    					}
		    					else if($.trim(data) == "adminNotAvailable")
		    					{
		    						$("#adminLogError").html("<h4>Invalid Username</h4>");
		    					}
		    					
		    				}
						})
					}//Ajax Request for Admin Login Ends

		    	})//Admin Login Ends

		})//document ends

