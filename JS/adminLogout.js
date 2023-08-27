		//document starts
		$("document").ready(function(){

			//Logout process Start
			$("#adminLogout").on("click",function(event){
				event.preventDefault();

				var action = "adminLogout";

				$.ajax({
					url: "./assests/logout.php",
					type: "POST",
					data: {'action':action},
					success: function(data)
					{	
						if($.trim(data) == "adminLogout")
						{
							window.location = "login.php";

						}
					}
				});
			})//Logout process Ends

			
			
		})//document ends