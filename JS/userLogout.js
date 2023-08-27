    	
		//document starts
		$("document").ready(function(){

			//Logout process Start
			$("#userLogout").on("click",function(event){
				event.preventDefault();

				var action = "userLogout";

				$.ajax({
					url: "./assests/logout.php",
					type: "POST",
					data: {'action':action},
					success: function(data)
					{	
						if($.trim(data) == "logout")
						{
							window.location = "login.php";
						}
					}
				});
			})//Logout process Ends

		})//document ends

